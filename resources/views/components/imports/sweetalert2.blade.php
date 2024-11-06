<div>
    <script type="module">
        console.log(Swal);
        @if ($errors->any())
            Swal.fire({
                icon:  "error",
                title: "資料驗證失敗",
                text:  "請按照欄位提示，輸入正確資料"
            });
        @endif
        @if(Session::has('response')&&
           isset(Session::get('response')['icon'])&&
           isset(Session::get('response')['title']))
            Swal.fire({
                icon:  "{{ Session::get('response')['icon'] }}",
                title: "{{ Session::get('response')['title'] }}",
                text:  "{{ Session::get('response')['text']??''}}"
            });
        @endif
    </script>
    <!-- The best way to take care of the future is to take care of the present moment. - Thich Nhat Hanh -->
</div>
