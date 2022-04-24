<?php

namespace Tests\Feature;

use App\Models\Comment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test comment creation
     *
     * @return void
     */
    public function testCreate()
    {

        $comment = factory(Comment::class)->make();

        $response = $this->postJson(route('comment.store'), $comment->toArray());

        $response->assertCreated();
        $this->assertDatabaseHas('comments', $comment->toArray());
    }

    /**
     * Test reply to a comment
     *
     * @return void
     */
    public function testReplyToComment()
    {

        $comment = factory(Comment::class)->create();
        $reply = factory(Comment::class)->make()->toArray();
        $reply['parent_id'] = $comment->id;

        $response = $this->postJson(route('comment.store'), $reply);

        $response->assertSuccessful();
        $this->assertDatabaseHas('comments', $reply);
    }

    /**
     * Test reply validation, should not able to reply when comment is already 4th layer.
     *
     * @return void
     */
    public function testValidationIsCommentHasTwoAncestors()
    {
        // Create first layer comment
        $comment = factory(Comment::class)->create();

        // Post second layer comment
        $reply = factory(Comment::class)->make()->toArray();
        $reply['parent_id'] = $comment->id;
        $second_comment_response = $this->postJson(route('comment.store'), $reply);

        // Post third layer comment
        $reply = factory(Comment::class)->make()->toArray();
        $reply['parent_id'] = $second_comment_response->decodeResponseJson()['id'];
        $third_comment_response = $this->postJson(route('comment.store'), $reply);

        // Post fourth layer comment
        $reply = factory(Comment::class)->make()->toArray();
        $reply['parent_id'] = $third_comment_response->decodeResponseJson()['id'];
        $fourth_comment_response = $this->postJson(route('comment.store'), $reply);

        $fourth_comment_response->assertStatus(422);
    }

    /**
     * Test name required validation
     *
     * @return void
     */
    public function testValidationNameFieldIsRequired()
    {
        $comment = factory(Comment::class)->make()->toArray();
        unset($comment['name']);

        $response = $this->postJson(route('comment.store'), $comment);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name']);
    }

    /**
     * Test comment required validation
     *
     * @return void
     */
    public function testValidationCommentFieldIsRequired()
    {
        $comment = factory(Comment::class)->make()->toArray();
        unset($comment['comment']);

        $response = $this->postJson(route('comment.store'), $comment);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['comment']);
    }

    /**
     * Test get all comments
     *
     * @return void
     */
    public function testFetchAll()
    {

        $comment = factory(Comment::class)->create();
        $reply = factory(Comment::class)->make()->toArray();
        $reply['parent_id'] = $comment->id;

        $this->postJson(route('comment.store'), $reply);
        $response = $this->get(route('comment.index'));

        $response->assertSuccessful();
        $response->assertJsonStructure(
            [
                0 => [
                    "id",
                    "name",
                    "comment",
                    "parent_id",
                    "created_at",
                    "updated_at",
                    "depth",
                    "path",
                    "children" => [
                        0 => [
                            "id",
                            "name",
                            "comment",
                            "parent_id",
                            "created_at",
                            "updated_at",
                            "depth",
                            "path",
                            "children"
                        ]
                    ]
                ]
            ]
        );
    }
}
