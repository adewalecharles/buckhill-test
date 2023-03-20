<?php
namespace App\Traits;

use App\Models\JwtToken;
use App\Models\User;
use DateTimeImmutable;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Encoding\UnixTimestampDates;
use Lcobucci\JWT\Token\Parser;
use Lcobucci\JWT\Token\Plain;
use Lcobucci\JWT\Validation\Constraint\IdentifiedBy;
use Lcobucci\JWT\Validation\Constraint\IssuedBy;
use Lcobucci\JWT\Validation\Constraint\StrictValidAt;
use Lcobucci\JWT\Validation\Constraint\SignedWith;
use Lcobucci\JWT\Validation\Validator;
use Lcobucci\JWT\Validation\Constraint\HasClaimWithValue;

trait HasJwtToken
{
    private array $claims = [];

    private array $permissions = [];

    private array $restrictions = [];

    private ?\DateTimeImmutable $expiresAt;

    private ?string $subject = null;

    /**
     * Set the claims to include in this JWT.
     */
    public function setClaims(array $claims): self
    {
        $this->claims = $claims;

        return $this;
    }


    public function setExpiresAt(\DateTimeImmutable $date): self
    {
        $this->expiresAt = $date;

        return $this;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function setPermissions(array $permissions):self
    {
        $this->$permissions = $permissions;

        return $this;
    }

    public function setRestrictions(array $restrictions): self
    {
        $this->$restrictions = $restrictions;

        return $this;
    }

    /**
     * Generate a new JWT for a given user.
     */
    public function createToken(): Plain
    {

        $config = Configuration::forAsymmetricSigner(
            new Sha256(),
            InMemory::File(base_path('/private.key')),
            InMemory::File(base_path('/private.key.pub'))
        );

        $now   = new DateTimeImmutable();

        $builder = $config->builder(new UnixTimestampDates())
            ->issuedBy(config('app.url'))
            // Configures the id (jti claim)
            ->identifiedBy((string)$this->uuid)
            // Configures the time that the token was issue (iat claim)
            ->issuedAt($now);

        if ($this->expiresAt) {
            $builder = $builder->expiresAt($this->expiresAt);
        }

        if (!empty($this->subject)) {
            $builder = $builder->relatedTo($this->subject)->withHeader('sub', $this->subject);
        }


        if (!empty($this->claims)) {
            foreach ($this->claims as $key => $value) {
                $builder = $builder->withClaim($key, $value);
            }
        }

        return $builder
            ->getToken($config->signer(), $config->signingKey());
    }

    /**
     * Function to validate jwt token
     *
     * @param string $token
     * @param User $user
     * @return boolean
     */
    public function validateToken(string $token, User $user):bool
    {
        $parser = new Parser(new JoseEncoder());

        $token = $parser->parse($token);

        $validator = new Validator();

        $signingKey   = InMemory::File(base_path('/private.key'));

        // check if the token belongs to the user
        if (!$validator->validate($token, new HasClaimWithValue('user_uuid', $user->uuid))) {
            return false;
        }

        // check if the token was issued by you
        if (!$validator->validate($token, new IssuedBy(config('app.url')))) {
            return false;
        }

        // check if the token identifier matches user
        if (!$validator->validate($token, new IdentifiedBy($user->uuid))) {
            return false;
        }

        // check if the token was signed with your key
        if (!$validator->validate($token, new SignedWith(new Sha256(), $signingKey))) {
            return false;
        }

        // check if the token has not expired
        // if (!$validator->validate($token, new StrictValidAt())) {
        //     return false;
        // }

        return true;

    }

    public function getTokenExpiration($token)
    {
        $token = (new Parser(new JoseEncoder()))->parse($token);

        $expiration = $token->getClaim('exp');

        return date('Y-m-d H:i:s', $expiration);
    }

    public function jwtToken(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(JwtToken::class);
    }
}
