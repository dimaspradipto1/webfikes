<?php

namespace Tests\Unit;

use App\Models\News;
use App\Models\User;
use App\Policies\NewsPolicy;
use Tests\TestCase;

class NewsPolicyTest extends TestCase
{
    public function test_admin_can_update_any_news(): void
    {
        $admin = new User(['name' => 'Admin', 'roles' => 'admin']);
        $author = new User(['name' => 'Author', 'roles' => 'penulis']);
        $author->id = 5;

        $news = new News(['title' => 'Test News']);
        $news->user_id = 99; // belongs to another user

        $policy = new NewsPolicy;

        // Admin before hook returns true
        $this->assertTrue($policy->before($admin, 'update') === true);
    }

    public function test_penulis_can_only_update_own_news(): void
    {
        $author = new User(['name' => 'Author', 'roles' => 'penulis']);
        $author->id = 5;

        $ownNews = new News(['title' => 'Own News']);
        $ownNews->user_id = 5;

        $otherNews = new News(['title' => 'Other News']);
        $otherNews->user_id = 99;

        $policy = new NewsPolicy;

        $this->assertTrue($policy->update($author, $ownNews));
        $this->assertFalse($policy->update($author, $otherNews));
    }
}
