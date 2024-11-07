<?php

namespace App\Interface;

interface ChanelInterface
{
    /**
     * Summary of fetchData
     * 讀取資料
     * 1.檔案
     * 2.API
     * 3.資料庫(ERP)
     * @return void
     */
    public function fetchData();
    /**
     * Summary of processData
     * 處理資料
     * 1.驗證
     * 2.格式轉換
     * 3.計算邏輯
     * @return void
     */
    public function processData();
    /**
     * Summary of writeData
     * 寫入資料
     * 1.檔案
     * 2.資料庫(MySQL、ERP)
     *
     * @return void
     */
    public function writeData();
}
