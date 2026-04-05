<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateAutosTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('autos');
        $table->addColumn('user_id', 'integer', ['null' => false])
              ->addColumn('marca', 'string', ['limit' => 100, 'null' => false])
              ->addColumn('modelo', 'string', ['limit' => 100, 'null' => false])
              ->addColumn('tipo_combustible', 'string', ['limit' => 50, 'null' => false])
              ->addColumn('estado', 'string', ['limit' => 50, 'default' => 'pendiente'])
              ->addColumn('fecha_limite', 'date', ['null' => true])
              ->addColumn('descripcion_es', 'text', ['null' => true])
              ->addColumn('descripcion_en', 'text', ['null' => true])
              ->addColumn('created', 'datetime', ['null' => true])
              ->addColumn('modified', 'datetime', ['null' => true])
              ->addForeignKey('user_id', 'users', 'id', ['delete' => 'CASCADE'])
              ->addIndex(['user_id'])
              ->create();
    }
}
