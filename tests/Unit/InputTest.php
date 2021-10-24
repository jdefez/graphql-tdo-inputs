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
        $input = new UserInput(
            firstname: 'Hank',
            lastname: 'Green',
            email: 'h.green@gmail.com'
        );

        $expected = [
            'input' => [
                'firstname' => 'Hank',
                'lastname' => 'Green',
                'email' => 'h.green@gmail.com',
                'mandates' => null,
                'managers' => null,
                'commitees' => null,
            ]
        ];

        $this->assertEquals($expected, $input->toArray());
    }

    /** @test */
    public function validation_fails_if_user_email_is_invalid()
    {
        $this->expectException(ValidationException::class);

        $input = new UserInput(
            firstname: 'Hank',
            lastname: 'Green',
            email: 'h[DOT]green[AT]gmail[DOT]com'
        );

        $expected = [
            'input' => [
                'firstname' => 'Hank',
                'lastname' => 'Green',
                'email' => 'h.green@gmail.com',
                'mandates' => null,
                'managers' => null,
                'commitees' => null,
            ]
        ];

        $this->assertEquals($expected, $input->toArray());
    }

    /** @test */
    public function user_can_have_a_mandates_create_relation_attribute()
    {
        $input = new UserInput(
            firstname: 'Hank',
            lastname: 'Green',
            email: 'h.green@gmail.com',
            createMandates: [
                [
                    'label' => 'elu-titulaire',
                    'name' => 'elu titulaire',
                    'credit' => 24,
                    'connectCommitee' => ['id' => 200],
                    'connectMandateDefinition' => ['id' => 14],
                ],
                [
                    'label' => 'tresorier-du-cssct',
                    'name' => 'tresorier du cssct',
                    'credit' => 24,
                    'connectCommitee' => ['id' => 200],
                    'connectMandateDefinition' => ['id' => 15],
                ],
            ],
            syncManagers: [
                [
                    'id' => 7
                ]
            ],
            syncCommitees: [
                [
                    'id' => 200,
                    'matricule' => 'qjx75',
                    'role' => 'user',
                ]
            ]
        );

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
                ],
                'managers' => [
                    'sync' => [
                        ['manager_id' => 7]
                    ]
                ],
                'commitees' => [
                    'sync' => [
                        [
                            'commitee_id' => 200,
                            'matricule' => 'qjx75',
                            'role' => 'user',
                        ]
                    ]
                ],
            ]
        ];

        $this->assertEquals($expected, $input->toArray());
    }
}
