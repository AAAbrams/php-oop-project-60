init-project: #инициализация проекта
	composer init

test:
	composer exec --verbose phpunit tests
