<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Sample data for dashboard
        $dashboardData = [
            'metrics' => [
                'total_revenue' => 245850000,
                'total_orders' => 1847,
                'total_customers' => 3249,
                'low_stock_products' => 24,
            ],
            'recent_orders' => [
                [
                    'id' => '12345',
                    'customer_name' => 'Nguyễn Văn A',
                    'customer_avatar' => 'default.jpg',
                    'total' => 2450000,
                    'status' => 'completed',
                    'created_at' => now()->subMinutes(2),
                ],
                [
                    'id' => '12344',
                    'customer_name' => 'Trần Thị B',
                    'customer_avatar' => 'default.jpg',
                    'total' => 1250000,
                    'status' => 'processing',
                    'created_at' => now()->subMinutes(15),
                ],
                [
                    'id' => '12343',
                    'customer_name' => 'Lê Văn C',
                    'customer_avatar' => 'default.jpg',
                    'total' => 850000,
                    'status' => 'shipping',
                    'created_at' => now()->subHour(),
                ],
            ],
            'top_products' => [
                [
                    'name' => 'MacBook Pro M3',
                    'image' => 'products/macbook-pro.jpg',
                    'sales_count' => 245,
                    'revenue' => 85000000,
                ],
                [
                    'name' => 'iPhone 15 Pro Max',
                    'image' => 'products/iphone-15.jpg',
                    'sales_count' => 189,
                    'revenue' => 67000000,
                ],
                [
                    'name' => 'AirPods Pro',
                    'image' => 'products/airpods-pro.jpg',
                    'sales_count' => 156,
                    'revenue' => 42000000,
                ],
            ],
            'pending_orders' => 12,
            'pending_reviews' => 8,
        ];

        return view('admin.dashboard', compact('dashboardData'));
    }

    public function products()
    {
        // Sample products data
        $products = [
            [
                'id' => 1,
                'name' => 'MacBook Pro M3 14inch',
                'sku' => 'MBP-M3-14',
                'brand' => 'Apple',
                'category' => 'Laptop',
                'price' => 54990000,
                'sale_price' => 52990000,
                'stock' => 25,
                'status' => 'active',
                'rating' => 4.8,
                'image' => 'products/macbook-pro.jpg',
                'created_at' => now()->subDays(2),
            ],
            [
                'id' => 2,
                'name' => 'iPhone 15 Pro Max 256GB',
                'sku' => 'IP15-PM-256',
                'brand' => 'Apple',
                'category' => 'Điện thoại',
                'price' => 32990000,
                'sale_price' => 0,
                'stock' => 5,
                'status' => 'active',
                'rating' => 4.6,
                'image' => 'products/iphone-15.jpg',
                'created_at' => now()->subDays(3),
            ],
            [
                'id' => 3,
                'name' => 'AirPods Pro 2nd Generation',
                'sku' => 'APD-PRO-2G',
                'brand' => 'Apple',
                'category' => 'Phụ kiện',
                'price' => 6490000,
                'sale_price' => 0,
                'stock' => 0,
                'status' => 'out_of_stock',
                'rating' => 4.9,
                'image' => 'products/airpods-pro.jpg',
                'created_at' => now()->subDays(4),
            ],
        ];

        return view('admin.products.index', compact('products'));
    }

    public function apiDashboardData()
    {
        // API endpoint for real-time data updates
        return response()->json([
            'metrics' => [
                'revenue' => rand(240000000, 250000000),
                'orders' => rand(1800, 1900),
                'customers' => rand(3200, 3300),
                'low_stock' => rand(20, 30),
            ],
            'chartData' => [
                'revenue' => [
                    'labels' => ['T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'CN'],
                    'datasets' => [
                        [
                            'label' => 'Doanh thu',
                            'data' => [
                                rand(60000000, 70000000),
                                rand(70000000, 80000000),
                                rand(75000000, 85000000),
                                rand(80000000, 90000000),
                                rand(85000000, 95000000),
                                rand(90000000, 100000000),
                                rand(85000000, 95000000)
                            ],
                            'borderColor' => '#3b82f6',
                            'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                        ]
                    ]
                ]
            ]
        ]);
    }
}
