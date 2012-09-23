# Makefile
#
#
ENV := dev

cc:
	php app/console cache:clear --env=$(ENV)

warmup:
	php app/console cache:warmup --env=$(ENV)

deletelogs:
	rm app/logs/apache.log app/logs/access.log
	touch app/logs/apache.log app/logs/access.log

database:
	php app/console doctrine:database:drop --force --env=$(ENV)
	php app/console doctrine:database:create --env=$(ENV)
	php app/console doctrine:schema:create --env=$(ENV)

dbupdate:
	php app/console doctrine:schema:update --force --env=$(ENV)

devusers:
	php app/console fos:user:create admin admin@localhost admin
	php app/console fos:user:promote admin ROLE_ADMIN
	php app/console fos:user:create user user@localhost user

projects:
	php app/console cibum:update

fixtures:
	php app/console doctrine:fixtures:load --env=$(ENV)

assets:
	app/console assets:install --symlink web
	app/console assetic:dump

permissions:
	setfacl -m default:group:www-data:rwX app/cache/
	setfacl -m default:user:$(USER):rwX app/cache/
	setfacl -m group:www-data:rwX app/cache/
	setfacl -m user:$(USER):rwX app/cache/
	setfacl -m default:group:www-data:rwX app/logs/
	setfacl -m default:user:$(USER):rwX app/logs/
	setfacl -m group:www-data:rwX app/logs/
	setfacl -m user:$(USER):rwX app/logs/
	rm -rf app/cache/* app/logs/*

vendors:
	bin/vendors install
	make assets

build_bootstrap:
	php vendor/bundles/Sensio/Bundle/DistributionBundle/Resources/bin/build_bootstrap.php

prod:
	rm -rf app/cache/*
	ENV=prod make warmup -e
	ENV=prod make assets -e
	chown hackaton:www-data . -R
	chmod g+w . -R

devsync:
	rsync --exclude-from=".rsyncignore" --copy-links --progress -vrae 'ssh -p 22' . root@176.31.133.25:/home/hackaton/hackaton
