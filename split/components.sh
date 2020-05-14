#!/usr/bin/env bash

BRANCHES='master develop testing'

COMPONENTS=(
    'components/Application/:git@github.com:niftycorner/limoncello-php-application.git'
    'components/Auth/:git@github.com:niftycorner/limoncello-php-auth.git'
    'components/Commands/:git@github.com:niftycorner/limoncello-php-commands.git'
    'components/Common/:git@github.com:niftycorner/limoncello-php-common.git'
    'components/Container/:git@github.com:niftycorner/limoncello-php-container.git'
    'components/Contracts/:git@github.com:niftycorner/limoncello-php-contracts.git'
    'components/Core/:git@github.com:niftycorner/limoncello-php-core.git'
    'components/Crypt/:git@github.com:niftycorner/limoncello-php-crypt.git'
    'components/Data/:git@github.com:niftycorner/limoncello-php-data.git'
    'components/Events/:git@github.com:niftycorner/limoncello-php-events.git'
    'components/Flute/:git@github.com:niftycorner/limoncello-php-flute.git'
    'components/L10n/:git@github.com:niftycorner/limoncello-php-l10n.git'
    'components/OAuthServer/:git@github.com:niftycorner/limoncello-php-oauth-server.git'
    'components/Passport/:git@github.com:niftycorner/limoncello-php-passport.git'
    'components/RedisTaggedCache/:git@github.com:niftycorner/limoncello-php-redis-tagged-cache.git'
    'components/Templates/:git@github.com:niftycorner/limoncello-php-templates.git'
    'components/Testing/:git@github.com:niftycorner/limoncello-php-testing.git'
    'components/Validation/:git@github.com:niftycorner/limoncello-php-validation.git'
)
