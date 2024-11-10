<div>
    <!-- He who is contented is rich. - Laozi -->
    <style>
        /* .upload-pre{
            width:100%;
            height:100vh;
            background: #d1d1d1;
            display: flex;
            justify-content: center;
            align-items: center;
        } */
        .upload-pre-item{
            width:300px;
            background: #fff;
            padding:20px;
            border: #0307f3 1px solid;
            border-radius: 15px;
            text-align: center;
            color:#333;
        }
        .upload-pre-item h1{
            font-weight:500;
            color:#0000;
        }
        .upload-pre-item img{
            width:200px;
            height:240px;
            border: #0307f3 1px solid;
            border-radius: 10%;
            margin: 0 auto;
            margin-top: 40px;
            margin-bottom: 30px;
        }
        .upload-file-button{
            display:block;
            width:200px;
            background: #e3362c;
            color: #fff;
            text-align: center;
            padding: 12px;
            margin: 1% auto;
            border-radius: 5px;
            cursor: pointer;
        }
        .upload-file{
            display: none;
        }
    </style>
    {{-- <div class="upload-pre"> --}}
        <div class="upload-pre-item">
            {{-- <h1>Title</h1>
            <p>Description</p> --}}
            <img src="{{ $src }}" alt="" id="{{ $image_id }}">
            <label for="{{ $file_id }}" class="upload-file-button">上傳圖片</label>
            <input type="file" name ="{{ $name }}" class="upload-file" accept="image/*" id="{{ $file_id }}">
        </div>
    {{-- </div> --}}
    <script>
        let {{ $file_id }} = document.getElementById('{{ $file_id }}');
        {{ $file_id }}.onchange=()=>{
            document.getElementById('{{ $image_id }}').src = URL.createObjectURL({{ $file_id }}.files[0]);
        };
    </script>
</div>
