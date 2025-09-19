<x-app-layout>
    <style>
        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(45deg, var(--gradient-from), var(--gradient-to));
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .stat-card.blue {
            --gradient-from: #3b82f6;
            --gradient-to: #1d4ed8;
        }

        .stat-card.purple {
            --gradient-from: #8b5cf6;
            --gradient-to: #7c3aed;
        }

        .stat-card.green {
            --gradient-from: #10b981;
            --gradient-to: #059669;
        }

        .stat-card.orange {
            --gradient-from: #f59e0b;
            --gradient-to: #d97706;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .stat-icon.blue {
            background: linear-gradient(45deg, #3b82f6, #1d4ed8);
        }

        .stat-icon.purple {
            background: linear-gradient(45deg, #8b5cf6, #7c3aed);
        }

        .stat-icon.green {
            background: linear-gradient(45deg, #10b981, #059669);
        }

        .stat-icon.orange {
            background: linear-gradient(45deg, #f59e0b, #d97706);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #6b7280;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .content-wrapper {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
            position: relative;
            min-height: 400px;
        }

        .content-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(45deg, #667eea, #764ba2);
        }

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .action-btn {
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid rgba(102, 126, 234, 0.2);
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            text-decoration: none;
            color: #374151;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
        }

        .action-btn:hover {
            background: rgba(102, 126, 234, 0.1);
            border-color: rgba(102, 126, 234, 0.4);
            transform: translateY(-2px);
            color: #667eea;
        }

        .action-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        /* Dark mode */
        .dark .stat-card {
            background: rgba(31, 41, 55, 0.95);
            border-color: rgba(255, 255, 255, 0.1);
        }

        .dark .stat-number {
            color: #f9fafb;
        }

        .dark .content-wrapper {
            background: rgba(31, 41, 55, 0.95);
            border-color: rgba(255, 255, 255, 0.1);
        }

        .dark .action-btn {
            background: rgba(31, 41, 55, 0.9);
            border-color: rgba(102, 126, 234, 0.3);
            color: #d1d5db;
        }

        .dark .action-btn:hover {
            background: rgba(102, 126, 234, 0.2);
            color: #a5b4fc;
        }

        /* 響應式 */
        @media (max-width: 768px) {
            .dashboard-stats {
                grid-template-columns: 1fr;
            }

            .quick-actions {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Welcome section */
        .welcome-section {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(102, 126, 234, 0.2);
            text-align: center;
        }

        .welcome-title {
            font-size: 1.5rem;
            font-weight: bold;
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }
    </style>
    <div class="py-8">
        <div class="max-w-7xl mx-auto">
            <!-- 主要內容區域 -->
            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>
    </div>
</x-app-layout>
