<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\ContactActivity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $contacts = [
            ['name' => 'Alice Johnson',    'email' => 'alice@techcorp.com',       'phone' => '+1-555-0101', 'company' => 'TechCorp',        'status' => 'active'],
            ['name' => 'Bob Williams',     'email' => 'bob@designstudio.io',      'phone' => '+1-555-0102', 'company' => 'Design Studio',   'status' => 'active'],
            ['name' => 'Carol Martinez',   'email' => 'carol@startupinc.com',     'phone' => '+1-555-0103', 'company' => 'Startup Inc',     'status' => 'lead'],
            ['name' => 'David Lee',        'email' => 'david@megacorp.org',       'phone' => '+1-555-0104', 'company' => 'MegaCorp',        'status' => 'active'],
            ['name' => 'Emma Davis',       'email' => 'emma@freelance.dev',       'phone' => '+1-555-0105', 'company' => 'Freelance',       'status' => 'inactive'],
            ['name' => 'Frank Brown',      'email' => 'frank@cloudservices.net',  'phone' => '+1-555-0106', 'company' => 'Cloud Services',  'status' => 'lead'],
            ['name' => 'Grace Wilson',     'email' => 'grace@dataco.com',         'phone' => '+1-555-0107', 'company' => 'DataCo',          'status' => 'active'],
            ['name' => 'Henry Taylor',     'email' => 'henry@webforge.io',        'phone' => '+1-555-0108', 'company' => 'WebForge',        'status' => 'active'],
            ['name' => 'Ivy Anderson',     'email' => 'ivy@innovatehub.com',      'phone' => '+1-555-0109', 'company' => 'InnovateHub',     'status' => 'lead'],
            ['name' => 'Jack Thomas',      'email' => 'jack@securetech.com',      'phone' => '+1-555-0110', 'company' => 'SecureTech',      'status' => 'active'],
            ['name' => 'Karen White',      'email' => 'karen@marketpro.com',      'phone' => '+1-555-0111', 'company' => 'MarketPro',       'status' => 'inactive'],
            ['name' => 'Liam Harris',      'email' => 'liam@apifactory.io',       'phone' => '+1-555-0112', 'company' => 'API Factory',     'status' => 'lead'],
            ['name' => 'Mia Clark',        'email' => 'mia@pixelworks.com',       'phone' => '+1-555-0113', 'company' => 'PixelWorks',      'status' => 'active'],
            ['name' => 'Noah Lewis',       'email' => 'noah@devhub.io',           'phone' => '+1-555-0114', 'company' => 'DevHub',          'status' => 'active'],
            ['name' => 'Olivia Walker',    'email' => 'olivia@greentech.com',     'phone' => '+1-555-0115', 'company' => 'GreenTech',       'status' => 'lead'],
            ['name' => 'Peter Hall',       'email' => 'peter@codesmith.dev',      'phone' => '+1-555-0116', 'company' => 'CodeSmith',       'status' => 'active'],
            ['name' => 'Quinn Allen',      'email' => 'quinn@synthwave.io',       'phone' => '+1-555-0117', 'company' => 'SynthWave',       'status' => 'inactive'],
            ['name' => 'Rachel Young',     'email' => 'rachel@brightideas.com',   'phone' => '+1-555-0118', 'company' => 'Bright Ideas',    'status' => 'active'],
            ['name' => 'Sam King',         'email' => 'sam@logicgate.com',        'phone' => '+1-555-0119', 'company' => 'LogicGate',       'status' => 'lead'],
            ['name' => 'Tina Wright',      'email' => 'tina@flowstate.io',        'phone' => '+1-555-0120', 'company' => 'FlowState',       'status' => 'active'],
            ['name' => 'Umar Lopez',       'email' => 'umar@nextstep.com',        'phone' => '+1-555-0121', 'company' => 'NextStep',        'status' => 'lead'],
            ['name' => 'Vera Hill',        'email' => 'vera@artisan.dev',         'phone' => '+1-555-0122', 'company' => 'Artisan Dev',     'status' => 'active'],
            ['name' => 'Will Scott',       'email' => 'will@basecamp.io',         'phone' => '+1-555-0123', 'company' => 'BaseCamp',        'status' => 'inactive'],
            ['name' => 'Xena Green',       'email' => 'xena@quantumleap.com',     'phone' => '+1-555-0124', 'company' => 'QuantumLeap',     'status' => 'lead'],
            ['name' => 'Yuki Adams',       'email' => 'yuki@skyline.io',          'phone' => '+1-555-0125', 'company' => 'Skyline',         'status' => 'active'],
        ];

        $activityTypes = [
            'created'  => 'Contact was created',
            'emailed'  => 'Sent introduction email',
            'called'   => 'Had a phone call',
            'updated'  => 'Contact details were updated',
            'note_added' => 'Added a note to contact',
        ];

        foreach ($contacts as $contactData) {
            $contact = Contact::updateOrCreate(
                ['email' => $contactData['email']],
                $contactData
            );

            // Add 2–4 activities per contact
            if ($contact->activities()->count() === 0) {
                $contact->activities()->create([
                    'type' => 'created',
                    'description' => 'Contact was created',
                ]);

                $extraActivities = array_rand(array_diff_key($activityTypes, ['created' => '']), rand(1, 3));
                $extraActivities = is_array($extraActivities) ? $extraActivities : [$extraActivities];

                foreach ($extraActivities as $type) {
                    $contact->activities()->create([
                        'type' => $type,
                        'description' => $activityTypes[$type],
                        'created_at' => now()->subMinutes(rand(10, 10000)),
                    ]);
                }
            }
        }
    }
}
