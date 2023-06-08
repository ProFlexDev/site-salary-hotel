use Doctrine\DBAL\Driver\PDO\MySQL\Driver;

return [
    'name' => 'My Project Migrations',
    'migrations_namespace' => 'MyProject\Migrations',
    'table_name' => 'migrations',
    'column_name' => 'version',
    'column_length' => 14,
    'executed_at_column_name' => 'executed_at',
    'all_or_nothing' => true,
    'check_database_platform' => true,
    'custom_template' => '',
    'organize_migrations' => 'none',
    'em' => [
        'connection' => 'default',
        'is_dev_mode' => true,
        'proxy_dir' => null,
        'cache' => null,
        'entity_dirs' => [],
    ],
    'all_or_nothing' => true,
    'check_database_platform' => true,
    'custom_template' => '',
    'organize_migrations' => 'none',
    'migrations_paths' => [
        'MyProject\Migrations' => 'db/migrations',
    ],
    'connection' => [
        'url' => 'mysql://user:password@localhost:3306/my_database',
        'driver' => 'pdo_mysql',
        'host' => 'localhost',
        'port' => 3306,
        'dbname' => '',
        'user' => '',
        'password' => '',
        'charset' => 'utf8mb4',
        'driverOptions' => [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci;',
            PDO::ATTR_EMULATE_PREPARES => true
        ]
    ]
];
