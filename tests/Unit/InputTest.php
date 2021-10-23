<?php

namespace Jean\GraphqlInputs\tests;

use Jean\GraphqlInputs\examples\UserInput;
use PHPUnit\Framework\TestCase;
use Spatie\DataTransferObject\Exceptions\ValidationException;

class InputTest extends TestCase
{
    /** @test */
    public function it_renders_user_input()
    {
        $input = new UserInput([
            'user_firstname' => 'Hank',
            'user_lastname' => 'Green',
            'user_email' => 'h.green@gmail.com',
        ]);

        $expected = [
            'input' => [
                'firstname' => 'Hank',
                'lastname' => 'Green',
                'email' => 'h.green@gmail.com',
                'mandates' => null,
            ]
        ];

        $this->assertEquals($expected, $input->toArray());
    }

    /** @test */
    public function validation_fails_if_user_email_is_invalid()
    {
        $this->expectException(ValidationException::class);

        $input = new UserInput([
            'user_firstname' => 'Hank',
            'user_lastname' => 'Green',
            'user_email' => 'h[DOT]green[AT]gmail[DOT]com',
        ]);

        $expected = [
            'input' => [
                'firstname' => 'Hank',
                'lastname' => 'Green',
                'email' => 'h.green@gmail.com',
                'mandates' => null,
            ]
        ];

        $this->assertEquals($expected, $input->toArray());
    }

    /** @test */
    public function user_can_have_a_mandates_create_relation_attribute()
    {
        $input = new UserInput([
            'user_firstname' => 'Hank',
            'user_lastname' => 'Green',
            'user_email' => 'h.green@gmail.com',
            'createMandates' => [
                [
                    'mandate_label' => 'elu-titulaire',
                    'mandate_name' => 'elu titulaire',
                    'mandate_credit' => 24,
                    'connectCommitee' => ['id' => 200],
                    'connectMandateDefinition' => ['id' => 14],
                ],
                [
                    'mandate_label' => 'tresorier-du-cssct',
                    'mandate_name' => 'tresorier du cssct',
                    'mandate_credit' => 24,
                    'connectCommitee' => ['id' => 200],
                    'connectMandateDefinition' => ['id' => 15],
                ],
            ]
        ]);

        $expected = [
            'input' => [
                'firstname' => 'Hank',
                'lastname' => 'Green',
                'email' => 'h.green@gmail.com',
                'mandates' => [
                    'create' => [
                        [
                            'label' => 'elu-titulaire',
                            'name' => 'elu titulaire',
                            'credit' => 24,
                            'mandateDefinition' => [
                                'connect' => 14
                            ],
                            'commitee' => [
                                'connect' => 200
                            ],
                        ],
                        [
                            'label' => 'tresorier-du-cssct',
                            'name' => 'tresorier du cssct',
                            'credit' => 24,
                            'mandateDefinition' => [
                                'connect' => 15
                            ],
                            'commitee' => [
                                'connect' => 200
                            ],
                        ],
                    ]
                ]
            ]
        ];

        $this->assertEquals($expected, $input->toArray());
    }
}
