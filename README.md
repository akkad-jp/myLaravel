# Laravelテンプレート

- インストール済みの開発補助ツール

## PHPstan
see [https://phpstan.org/](https://phpstan.org/)
```
# PHP の構文をチェックする(app ディレクトリ、レベル6 で実行)
dev/phpstan.sh

# チェックするディレクトリを指定する
dev/phpstan.sh app/Http/Controllers

# チェックレベルを指定する(0〜9)
dev/phpstan.sh -l 6
```

## L5-Swagger
see [https://github.com/DarkaOnLine/L5-Swagger](https://github.com/DarkaOnLine/L5-Swagger)
### ドキュメント作成
```
dev/swagger.sh
```
### ドキュメント閲覧
- [http://localhost/api/documentation](http://localhost/api/documentation)

## ESLint
see [https://eslint.org/](https://eslint.org/)
```
sail npm run lint
```

## 開発環境構築
### プロジェクトをクローン
```
cd $PROJEXT_DIR
git clone https://github.com/jun1-akkad/myLaravel.git
cd myLaravel
```

### .env 作成
```
cp .env.example .env
```

### composer install
- 一時的なコンテナ上で`composer install` を実行する。これにより、ホストOSにPHP やcomposer をインストールする必要がなくなる。
```
docker run --rm -u "$(id -u):$(id -g)" -v $(pwd):/var/www/html -w /var/www/html laravelsail/php82-composer:latest composer install --ignore-platform-reqs
```
（エラーが出る場合、環境によっては以下のコマンドを叩いてみる）
```
sudo gpasswd -a $(whoami) docker
sudo chgrp docker /var/run/docker.sock
sudo service docker restart
```

- 終了するまでそれなりに時間がかかる。終わったらコンテナを起動してみる。
```
sail up -d
```

### Laravel 初期設定
```
sail artisan key:generate
sail artisan migrate
```
### Auth0 の設定
- 「.auth0.app.json」「.auth0.api.json」をプロジェクトのルートにコピーする。  
または、docs/環境構築.md に記載の手順に従って作成する。

### Vue 関連モジュールをインストール
```
sail npm ci
```

## 動作確認
- (sail が立ち上がっていない場合)
```
sail up -d
```

- Vue をdevelop モードで起動する
```
sail npm run dev
```

- http://localhost/ をブラウザで確認する
