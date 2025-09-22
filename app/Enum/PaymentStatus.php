<?php

// ==========================================
// app/Enum/PaymentStatus.php
// ==========================================

namespace App\Enum;

enum PaymentStatus: int
{
    case PENDING  = 1;
    case PAID     = 2;
    case FAILED   = 3;
    case REFUNDED = 4;

    // ==========================================
    // 取得狀態標籤（中文）
    // ==========================================

    public function label(): string
    {
        return match($this) {
            self::PENDING  => '待付款',
            self::PAID     => '已付款',
            self::FAILED   => '付款失敗',
            self::REFUNDED => '已退款',
        };
    }

    // ==========================================
    // 取得狀態標籤（英文）
    // ==========================================

    public function labelEn(): string
    {
        return match($this) {
            self::PENDING  => 'Pending',
            self::PAID     => 'Paid',
            self::FAILED   => 'Failed',
            self::REFUNDED => 'Refunded',
        };
    }

    // ==========================================
    // 取得狀態顏色（用於前端顯示）
    // ==========================================

    public function color(): string
    {
        return match($this) {
            self::PENDING  => 'orange',
            self::PAID     => 'green',
            self::FAILED   => 'red',
            self::REFUNDED => 'blue',
        };
    }

    // ==========================================
    // 取得狀態圖示
    // ==========================================

    public function icon(): string
    {
        return match($this) {
            self::PENDING  => 'clock',
            self::PAID     => 'check-circle',
            self::FAILED   => 'x-circle',
            self::REFUNDED => 'arrow-left-circle',
        };
    }

    // ==========================================
    // 取得狀態說明
    // ==========================================

    public function description(): string
    {
        return match($this) {
            self::PENDING  => '等待客戶完成付款',
            self::PAID     => '付款已成功完成',
            self::FAILED   => '付款處理失敗',
            self::REFUNDED => '款項已退還給客戶',
        };
    }

    // ==========================================
    // 付款狀態流程檢查方法
    // ==========================================

    /**
     * 檢查是否可以轉換到指定狀態
     */
    public function canTransitionTo(PaymentStatus $newStatus): bool
    {
        return match($this) {
            self::PENDING => in_array($newStatus, [
                self::PAID,
                self::FAILED
            ]),

            self::PAID => in_array($newStatus, [
                self::REFUNDED
            ]),

            self::FAILED => in_array($newStatus, [
                self::PENDING,  // 可以重新嘗試付款
                self::PAID      // 手動標記為已付款
            ]),

            self::REFUNDED => false, // 已退款無法改變
        };
    }

    /**
     * 取得可以轉換的下一個狀態
     */
    public function getNextStatuses(): array
    {
        return match($this) {
            self::PENDING  => [self::PAID, self::FAILED],
            self::PAID     => [self::REFUNDED],
            self::FAILED   => [self::PENDING, self::PAID],
            self::REFUNDED => [],
        };
    }

    /**
     * 檢查是否為最終狀態
     */
    public function isFinal(): bool
    {
        return $this === self::REFUNDED;
    }

    /**
     * 檢查是否為成功狀態
     */
    public function isSuccess(): bool
    {
        return $this === self::PAID;
    }

    /**
     * 檢查是否為失敗狀態
     */
    public function isFailed(): bool
    {
        return $this === self::FAILED;
    }

    /**
     * 檢查是否需要客戶操作
     */
    public function requiresCustomerAction(): bool
    {
        return in_array($this, [self::PENDING, self::FAILED]);
    }

    // ==========================================
    // 靜態方法
    // ==========================================

    /**
     * 取得所有狀態的標籤對應
     */
    public static function getAllLabels(): array
    {
        $labels = [];
        foreach (self::cases() as $status) {
            $labels[$status->value] = $status->label();
        }
        return $labels;
    }

    /**
     * 取得需要處理的狀態（待付款和失敗）
     */
    public static function getPendingStatuses(): array
    {
        return [self::PENDING, self::FAILED];
    }

    /**
     * 取得已完成的狀態（已付款和已退款）
     */
    public static function getCompletedStatuses(): array
    {
        return [self::PAID, self::REFUNDED];
    }

    /**
     * 根據數值取得 Enum
     */
    public static function fromValue(int $value): ?self
    {
        return self::tryFrom($value);
    }

    /**
     * 取得預設狀態
     */
    public static function default(): self
    {
        return self::PENDING;
    }
}
