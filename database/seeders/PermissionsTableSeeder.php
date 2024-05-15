<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'team_create',
            ],
            [
                'id'    => 18,
                'title' => 'team_edit',
            ],
            [
                'id'    => 19,
                'title' => 'team_show',
            ],
            [
                'id'    => 20,
                'title' => 'team_delete',
            ],
            [
                'id'    => 21,
                'title' => 'team_access',
            ],
            [
                'id'    => 22,
                'title' => 'admin_access',
            ],
            [
                'id'    => 23,
                'title' => 'organe_create',
            ],
            [
                'id'    => 24,
                'title' => 'organe_edit',
            ],
            [
                'id'    => 25,
                'title' => 'organe_show',
            ],
            [
                'id'    => 26,
                'title' => 'organe_delete',
            ],
            [
                'id'    => 27,
                'title' => 'organe_access',
            ],
            [
                'id'    => 28,
                'title' => 'satzung_create',
            ],
            [
                'id'    => 29,
                'title' => 'satzung_edit',
            ],
            [
                'id'    => 30,
                'title' => 'satzung_show',
            ],
            [
                'id'    => 31,
                'title' => 'satzung_delete',
            ],
            [
                'id'    => 32,
                'title' => 'satzung_access',
            ],
            [
                'id'    => 33,
                'title' => 'finanzen_create',
            ],
            [
                'id'    => 34,
                'title' => 'finanzen_edit',
            ],
            [
                'id'    => 35,
                'title' => 'finanzen_show',
            ],
            [
                'id'    => 36,
                'title' => 'finanzen_delete',
            ],
            [
                'id'    => 37,
                'title' => 'finanzen_access',
            ],
            [
                'id'    => 38,
                'title' => 'finanzkategorien_create',
            ],
            [
                'id'    => 39,
                'title' => 'finanzkategorien_edit',
            ],
            [
                'id'    => 40,
                'title' => 'finanzkategorien_show',
            ],
            [
                'id'    => 41,
                'title' => 'finanzkategorien_delete',
            ],
            [
                'id'    => 42,
                'title' => 'finanzkategorien_access',
            ],
            [
                'id'    => 43,
                'title' => 'veranstaltung_create',
            ],
            [
                'id'    => 44,
                'title' => 'veranstaltung_edit',
            ],
            [
                'id'    => 45,
                'title' => 'veranstaltung_show',
            ],
            [
                'id'    => 46,
                'title' => 'veranstaltung_delete',
            ],
            [
                'id'    => 47,
                'title' => 'veranstaltung_access',
            ],
            [
                'id'    => 48,
                'title' => 'mitglieds_typ_create',
            ],
            [
                'id'    => 49,
                'title' => 'mitglieds_typ_edit',
            ],
            [
                'id'    => 50,
                'title' => 'mitglieds_typ_show',
            ],
            [
                'id'    => 51,
                'title' => 'mitglieds_typ_delete',
            ],
            [
                'id'    => 52,
                'title' => 'mitglieds_typ_access',
            ],
            [
                'id'    => 53,
                'title' => 'mitglied_create',
            ],
            [
                'id'    => 54,
                'title' => 'mitglied_edit',
            ],
            [
                'id'    => 55,
                'title' => 'mitglied_show',
            ],
            [
                'id'    => 56,
                'title' => 'mitglied_delete',
            ],
            [
                'id'    => 57,
                'title' => 'mitglied_access',
            ],
            [
                'id'    => 58,
                'title' => 'verein_create',
            ],
            [
                'id'    => 59,
                'title' => 'verein_edit',
            ],
            [
                'id'    => 60,
                'title' => 'verein_show',
            ],
            [
                'id'    => 61,
                'title' => 'verein_delete',
            ],
            [
                'id'    => 62,
                'title' => 'verein_access',
            ],
            [
                'id'    => 63,
                'title' => 'aktion_create',
            ],
            [
                'id'    => 64,
                'title' => 'aktion_edit',
            ],
            [
                'id'    => 65,
                'title' => 'aktion_show',
            ],
            [
                'id'    => 66,
                'title' => 'aktion_delete',
            ],
            [
                'id'    => 67,
                'title' => 'aktion_access',
            ],
            [
                'id'    => 68,
                'title' => 'ort_create',
            ],
            [
                'id'    => 69,
                'title' => 'ort_edit',
            ],
            [
                'id'    => 70,
                'title' => 'ort_show',
            ],
            [
                'id'    => 71,
                'title' => 'ort_delete',
            ],
            [
                'id'    => 72,
                'title' => 'ort_access',
            ],
            [
                'id'    => 73,
                'title' => 'tag_create',
            ],
            [
                'id'    => 74,
                'title' => 'tag_edit',
            ],
            [
                'id'    => 75,
                'title' => 'tag_show',
            ],
            [
                'id'    => 76,
                'title' => 'tag_delete',
            ],
            [
                'id'    => 77,
                'title' => 'tag_access',
            ],
            [
                'id'    => 78,
                'title' => 'texte_create',
            ],
            [
                'id'    => 79,
                'title' => 'texte_edit',
            ],
            [
                'id'    => 80,
                'title' => 'texte_show',
            ],
            [
                'id'    => 81,
                'title' => 'texte_delete',
            ],
            [
                'id'    => 82,
                'title' => 'texte_access',
            ],
            [
                'id'    => 83,
                'title' => 'template_create',
            ],
            [
                'id'    => 84,
                'title' => 'template_edit',
            ],
            [
                'id'    => 85,
                'title' => 'template_show',
            ],
            [
                'id'    => 86,
                'title' => 'template_delete',
            ],
            [
                'id'    => 87,
                'title' => 'template_access',
            ],
            [
                'id'    => 88,
                'title' => 'website_access',
            ],
            [
                'id'    => 89,
                'title' => 'webmenu_create',
            ],
            [
                'id'    => 90,
                'title' => 'webmenu_edit',
            ],
            [
                'id'    => 91,
                'title' => 'webmenu_show',
            ],
            [
                'id'    => 92,
                'title' => 'webmenu_delete',
            ],
            [
                'id'    => 93,
                'title' => 'webmenu_access',
            ],
            [
                'id'    => 94,
                'title' => 'artikel_create',
            ],
            [
                'id'    => 95,
                'title' => 'artikel_edit',
            ],
            [
                'id'    => 96,
                'title' => 'artikel_show',
            ],
            [
                'id'    => 97,
                'title' => 'artikel_delete',
            ],
            [
                'id'    => 98,
                'title' => 'artikel_access',
            ],
            [
                'id'    => 99,
                'title' => 'finance_access',
            ],
            [
                'id'    => 100,
                'title' => 'submenu_create',
            ],
            [
                'id'    => 101,
                'title' => 'submenu_edit',
            ],
            [
                'id'    => 102,
                'title' => 'submenu_show',
            ],
            [
                'id'    => 103,
                'title' => 'submenu_delete',
            ],
            [
                'id'    => 104,
                'title' => 'submenu_access',
            ],
            [
                'id'    => 105,
                'title' => 'hilf_access',
            ],
            [
                'id'    => 106,
                'title' => 'howto_create',
            ],
            [
                'id'    => 107,
                'title' => 'howto_edit',
            ],
            [
                'id'    => 108,
                'title' => 'howto_show',
            ],
            [
                'id'    => 109,
                'title' => 'howto_delete',
            ],
            [
                'id'    => 110,
                'title' => 'howto_access',
            ],
            [
                'id'    => 111,
                'title' => 'faq_create',
            ],
            [
                'id'    => 112,
                'title' => 'faq_edit',
            ],
            [
                'id'    => 113,
                'title' => 'faq_show',
            ],
            [
                'id'    => 114,
                'title' => 'faq_delete',
            ],
            [
                'id'    => 115,
                'title' => 'faq_access',
            ],
            [
                'id'    => 116,
                'title' => 'howto_nc_create',
            ],
            [
                'id'    => 117,
                'title' => 'howto_nc_edit',
            ],
            [
                'id'    => 118,
                'title' => 'howto_nc_show',
            ],
            [
                'id'    => 119,
                'title' => 'howto_nc_delete',
            ],
            [
                'id'    => 120,
                'title' => 'howto_nc_access',
            ],
            [
                'id'    => 121,
                'title' => 'help_access',
            ],
            [
                'id'    => 122,
                'title' => 'faq_nc_create',
            ],
            [
                'id'    => 123,
                'title' => 'faq_nc_edit',
            ],
            [
                'id'    => 124,
                'title' => 'faq_nc_show',
            ],
            [
                'id'    => 125,
                'title' => 'faq_nc_delete',
            ],
            [
                'id'    => 126,
                'title' => 'faq_nc_access',
            ],
            [
                'id'    => 127,
                'title' => 'verein_single_create',
            ],
            [
                'id'    => 128,
                'title' => 'verein_single_edit',
            ],
            [
                'id'    => 129,
                'title' => 'verein_single_show',
            ],
            [
                'id'    => 130,
                'title' => 'verein_single_delete',
            ],
            [
                'id'    => 131,
                'title' => 'verein_single_access',
            ],
            [
                'id'    => 132,
                'title' => 'counter_create',
            ],
            [
                'id'    => 133,
                'title' => 'counter_edit',
            ],
            [
                'id'    => 134,
                'title' => 'counter_show',
            ],
            [
                'id'    => 135,
                'title' => 'counter_delete',
            ],
            [
                'id'    => 136,
                'title' => 'counter_access',
            ],
            [
                'id'    => 137,
                'title' => 'image_create',
            ],
            [
                'id'    => 138,
                'title' => 'image_edit',
            ],
            [
                'id'    => 139,
                'title' => 'image_show',
            ],
            [
                'id'    => 140,
                'title' => 'image_delete',
            ],
            [
                'id'    => 141,
                'title' => 'image_access',
            ],
            [
                'id'    => 142,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
