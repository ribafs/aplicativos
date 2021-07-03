cd /var/www/html
git clone git://github.com/thorsten/phpMyFAQ.git
cd phpMyFAQ
composer install
curl -o- -L https://yarnpkg.com/install.sh | bash
sudo npm install yarn -g
yarn install
yarn build

Criar um banco e um usuário com todos os privilégios sobre o banco e com senha para usar no phpmyfaq

http://localhost/phpMyFAQ/phpmyfaq


