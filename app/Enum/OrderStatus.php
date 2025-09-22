<?php

// ==========================================
// app/Enum/OrderStatus.php
// ==========================================

namespace App\Enum;

enum OrderStatus: int
{
    case PENDING   = 1;
    case CONFIRMED = 2;
    case SHIPPED   = 3;
    case FINISHED  = 4;
    case CANCELLED = 5;

    // ==========================================
    // 取得狀態標籤（中文）
    // ==========================================

    public function label(): string
    {
        return match($this) {
            self::PENDING   => '待確認',
            self::CONFIRMED => '已確認',
            self::SHIPPED   => '已出貨',
            self::FINISHED  => '已完成',
            self::CANCELLED => '已取消',
        };
    }

    // ==========================================
    // 取得狀態標籤（英文）
    // ==========================================

    public function labelEn(): string
    {
        return match($this) {
            self::PENDING   => 'Pending',
            self::CONFIRMED => 'Confirmed',
            self::SHIPPED   => 'Shipped',
            self::FINISHED  => 'Finished',
            self::CANCELLED => 'Cancelled',
        };
    }

    // ==========================================
    // 取得狀態顏色（用於前端顯示）
    // ==========================================

    public function color(): string
    {
        return match($this) {
            self::PENDING   => 'orange',
            self::CONFIRMED => 'blue',
            self::SHIPPED   => 'purple',
            self::FINISHED  => 'green',
            self::CANCELLED => 'red',
        };
    }

    // ==========================================
    // 取得狀態說明
    // ==========================================

    public function description(): string
    {
        return match($this) {
            self::PENDING   => '訂單已建立，等待確認中',
            self::CONFIRMED => '訂單已確認，準備出貨',
            self::SHIPPED   => '商品已出貨，運送中',
            self::FINISHED  => '訂單已完成',
            self::CANCELLED => '訂單已取消',
        };
    }

    // ==========================================
    // 狀態流程檢查方法
    // ==========================================

    /**
     * 檢查是否可以轉換到指定狀態
     */
    public function canTransitionTo(OrderStatus $newStatus): bool
    {
        return match($this) {
            self::PENDING => in_array($newStatus, [
                self::CONFIRMED,
                self::CANCELLED
            ]),

            self::CONFIRMED => in_array($newStatus, [
                self::SHIPPED,
                self::CANCELLED
            ]),

            self::SHIPPED => in_array($newStatus, [
                self::FINISHED
            ]),

            self::FINISHED => false, // 已完成無法改變

            self::CANCELLED => false, // 已取消無法改變
        };
    }

    /**
     * 取得可以轉換的下一個狀態
     */
    public function getNextStatuses(): array
    {
        return match($this) {
            self::PENDING   => [self::CONFIRMED, self::CANCELLED],
            self::CONFIRMED => [self::SHIPPED, self::CANCELLED],
            self::SHIPPED   => [self::FINISHED],
            self::FINISHED  => [],
            self::CANCELLED => [],
        };
    }

    /**
     * 檢查是否為終態（無法再變更）
     */
    public function isFinal(): bool
    {
        return in_array($this, [self::FINISHED, self::CANCELLED]);
    }

    /**
     * 檢查是否為進行中狀態
     */
    public function isActive(): bool
    {
        return in_array($this, [self::PENDING, self::CONFIRMED, self::SHIPPED]);
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
     * 取得可選擇的狀態（排除已完成和已取消）
     */
    public static function getSelectableStatuses(): array
    {
        return array_filter(self::cases(), function ($status) {
            return !$status->isFinal();
        });
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
