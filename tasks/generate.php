<?php

use Admin\Models\Permission as Permission;
use Admin\Models\Role as Role;
use Admin\Models\User as User;
use Laravel\CLI\Command as Command;

/**
 * Initial data generator for photos bundle
 */
class Photos_Generate_Task {

    /**
     * Common code for all methods
     */
    public function __construct()
    {
        // Start the admin bundle in case it hasn't started
        Bundle::start('admin');
        $perms = Permission::where_in('name',
                                      array('Manage Photos'))->count();
        $role = Role::where_name('Photo Manager')->count();
        if ($perms > 0 or $role > 0) {
            die("Photos roles and permissions already generated... Aborting\n");
        }
    }

    /**
     * Default action which responds to admin::generate
     */
    public function run()
    {
        // Run the loaders
        $this->permissions();
        $this->roles();
        Command::run(array('admin::manage:update_admin_permissions'));
        print "[Finished]\n";
    }

    /**
     * Generate permissions
     */
    private function permissions()
    {
        print "Generating Photos permissions...\n";
        $data = array(
            array(
                'name' => 'Manage Photos',
                'description' => 'Access photos management in admin panel',
            ),
        );
        foreach ($data as $row) {
            $perm = new Permission($row);
            $perm->save();
        }
    }

    /**
     * Generate roles
     */
    private function roles()
    {
        print "Generating Photos roles...\n";
        $data = array(
            array(
                'name' => 'Photo Manager',
                'description' => 'Photo Managers can create new galleries and manage photos',
                'weight' => '13',
                'perms' => Permission::where_in('name',
                                                array('Manage Photos'
                                                ))->get(),
            )
        );
        foreach ($data as $row) {
            $role = new Role(array('name' => $row['name'],
                                   'description' => $row['description'],
                                   'weight' => $row['weight']));
            $role->save();
            foreach($row['perms'] as $perm) {
                $role->permissions()->attach($perm->id);
            }
        }
    }

}
