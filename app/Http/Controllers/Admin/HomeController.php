<?php

namespace App\Http\Controllers\Admin;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController
{
    public function index()
    {
        $settings1 = [
            'chart_title'        => 'Mitglieder',
            'chart_type'         => 'pie',
            'report_type'        => 'group_by_relationship',
            'model'              => 'App\Models\Mitglied',
            'group_by_field'     => 'bezeichnung',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'column_class'       => 'col-md-6',
            'entries_number'     => '5',
            'relationship_name'  => 'type',
            'translation_key'    => 'mitglied',
        ];

        $chart1 = new LaravelChart($settings1);

        $settings2 = [
            'chart_title'           => 'Neueste Mitglieder',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Mitglied',
            'group_by_field'        => 'eintritt',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd.m.Y',
            'column_class'          => 'col-md-6',
            'entries_number'        => '10',
            'fields'                => [
                'name'     => '',
                'eintritt' => '',
            ],
            'translation_key' => 'mitglied',
        ];

        $settings2['data'] = [];
        if (class_exists($settings2['model'])) {
            $settings2['data'] = $settings2['model']::latest()
                ->take($settings2['entries_number'])
                ->get();
        }

        if (! array_key_exists('fields', $settings2)) {
            $settings2['fields'] = [];
        }

        $settings3 = [
            'chart_title'           => 'Finanzpegel',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Finanzen',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'sum',
            'aggregate_field'       => 'betrag',
            'filter_field'          => 'created_at',
            'filter_period'         => 'year',
            'group_by_field_format' => 'd.m.Y H:i:s',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
            'translation_key'       => 'finanzen',
        ];

        $settings3['total_number'] = 0;
        if (class_exists($settings3['model'])) {
            $settings3['total_number'] = $settings3['model']::when(isset($settings3['filter_field']), function ($query) use ($settings3) {
                if (isset($settings3['filter_days'])) {
                    return $query->where($settings3['filter_field'], '>=',
                        now()->subDays($settings3['filter_days'])->format('Y-m-d'));
                } elseif (isset($settings3['filter_period'])) {
                    switch ($settings3['filter_period']) {
                        case 'week': $start = date('Y-m-d', strtotime('last Monday'));
                        break;
                        case 'month': $start = date('Y-m') . '-01';
                        break;
                        case 'year': $start = date('Y') . '-01-01';
                        break;
                    }
                    if (isset($start)) {
                        return $query->where($settings3['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings3['aggregate_function'] ?? 'count'}($settings3['aggregate_field'] ?? '*');
        }

        $settings4 = [
            'chart_title'           => 'Eintritte',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Mitglied',
            'group_by_field'        => 'eintritt',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_period'         => 'year',
            'group_by_field_format' => 'd.m.Y',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
            'translation_key'       => 'mitglied',
        ];

        $settings4['total_number'] = 0;
        if (class_exists($settings4['model'])) {
            $settings4['total_number'] = $settings4['model']::when(isset($settings4['filter_field']), function ($query) use ($settings4) {
                if (isset($settings4['filter_days'])) {
                    return $query->where($settings4['filter_field'], '>=',
                        now()->subDays($settings4['filter_days'])->format('Y-m-d'));
                } elseif (isset($settings4['filter_period'])) {
                    switch ($settings4['filter_period']) {
                        case 'week': $start = date('Y-m-d', strtotime('last Monday'));
                        break;
                        case 'month': $start = date('Y-m') . '-01';
                        break;
                        case 'year': $start = date('Y') . '-01-01';
                        break;
                    }
                    if (isset($start)) {
                        return $query->where($settings4['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings4['aggregate_function'] ?? 'count'}($settings4['aggregate_field'] ?? '*');
        }

        $settings5 = [
            'chart_title'           => 'Austritte',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Mitglied',
            'group_by_field'        => 'eintritt',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_period'         => 'year',
            'group_by_field_format' => 'd.m.Y',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
            'translation_key'       => 'mitglied',
        ];

        $settings5['total_number'] = 0;
        if (class_exists($settings5['model'])) {
            $settings5['total_number'] = $settings5['model']::when(isset($settings5['filter_field']), function ($query) use ($settings5) {
                if (isset($settings5['filter_days'])) {
                    return $query->where($settings5['filter_field'], '>=',
                        now()->subDays($settings5['filter_days'])->format('Y-m-d'));
                } elseif (isset($settings5['filter_period'])) {
                    switch ($settings5['filter_period']) {
                        case 'week': $start = date('Y-m-d', strtotime('last Monday'));
                        break;
                        case 'month': $start = date('Y-m') . '-01';
                        break;
                        case 'year': $start = date('Y') . '-01-01';
                        break;
                    }
                    if (isset($start)) {
                        return $query->where($settings5['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings5['aggregate_function'] ?? 'count'}($settings5['aggregate_field'] ?? '*');
        }

        $settings6 = [
            'chart_title'        => 'Besucherzahlen',
            'chart_type'         => 'bar',
            'report_type'        => 'group_by_string',
            'model'              => 'App\Models\Counter',
            'group_by_field'     => 'bezeichnung',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'column_class'       => 'col-md-6',
            'entries_number'     => '5',
            'translation_key'    => 'counter',
        ];

        $chart6 = new LaravelChart($settings6);

        return view('home', compact('chart1', 'chart6', 'settings2', 'settings3', 'settings4', 'settings5'));
    }
}
