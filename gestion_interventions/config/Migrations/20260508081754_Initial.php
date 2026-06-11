<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class Initial extends BaseMigration
{
    /**
     * Up Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/5/en/migrations.html#the-up-method
     *
     * @return void
     */
    public function up(): void
    {
        $this->table('interventions')
            ->addColumn('date_intervention', 'date', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('observation', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('beneficiaire', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => false,
            ])
            ->addColumn('type_intervention', 'string', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('statut', 'string', [
                'default' => 'cours',
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                $this->index('user_id')
                    ->setName('user_id')
            )
            ->create();

        $this->table('livrables')
            ->addColumn('date_livraison', 'date', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('etat', 'string', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('direction', 'string', [
                'default' => null,
                'limit' => 150,
                'null' => true,
            ])
            ->addColumn('intervention_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                $this->index('intervention_id')
                    ->setName('intervention_id')
            )
            ->create();

        $this->table('users')
            ->addColumn('nom', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('prenom', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('email', 'string', [
                'default' => null,
                'limit' => 150,
                'null' => false,
            ])
            ->addColumn('password', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('role', 'string', [
                'default' => 'technicien',
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                $this->index('email')
                    ->setName('email')
                    ->setType('unique')
            )
            ->create();

        $this->table('interventions')
            ->addForeignKey(
                $this->foreignKey('user_id')
                    ->setReferencedTable('users')
                    ->setReferencedColumns('id')
                    ->setDelete('RESTRICT')
                    ->setUpdate('RESTRICT')
                    ->setName('interventions_ibfk_1')
            )
            ->update();

        $this->table('livrables')
            ->addForeignKey(
                $this->foreignKey('intervention_id')
                    ->setReferencedTable('interventions')
                    ->setReferencedColumns('id')
                    ->setDelete('RESTRICT')
                    ->setUpdate('RESTRICT')
                    ->setName('livrables_ibfk_1')
            )
            ->update();
    }

    /**
     * Down Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/5/en/migrations.html#the-down-method
     *
     * @return void
     */
    public function down(): void
    {
        $this->table('interventions')
            ->dropForeignKey(
                'user_id'
            )->save();

        $this->table('livrables')
            ->dropForeignKey(
                'intervention_id'
            )->save();

        $this->table('interventions')->drop()->save();
        $this->table('livrables')->drop()->save();
        $this->table('users')->drop()->save();
    }
}
