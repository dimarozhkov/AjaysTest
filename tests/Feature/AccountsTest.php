<?php

namespace Tests\Feature;

use Tests\TestCase;

class AccountsTest extends TestCase
{
    public function testSuccessfulGetAccounts()
    {
        $response = $this->get('/api/account');
        $response->assertStatus(200);
    }

    public function testSuccessfulGetAccountsWithSort()
    {
        $response = $this->get('/api/account?orderBy=id&orderCondition=asc');
        $response->assertStatus(200);
    }
}
