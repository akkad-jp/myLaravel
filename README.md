# aihub-platform

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
