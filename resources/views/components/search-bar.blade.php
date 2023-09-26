<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <div class="row w-auto m-3">
        <div class="form-group">
            <input class="form-control mr-sm-2 form-controller icon-rtl" id="search"  type="search" placeholder="Search" aria-label="Search">
        </div>
        <div class="scrollbar panel panel-default overflow-y-scroll p-relative" style="height: fit-content; max-height: 40vh; background-color: lightslategrey; position: relative;" style="height: 30vw">
            <div class="panel-body">
                <table >
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<script type="text/javascript">
    $('#search').on('keyup',function(){
    $value=$(this).val();
    $.ajax({
    type : 'get',
    url : '{{URL::to('api/products')}}',
    data:{'searchKey':$value},
    success:function(data){
    console.log(data['data']);
    returnedData = '';
    data['data']['results'].forEach(element => {
        returnedData+='<div>'+element['title']+'</div><br>';
    });
        $('tbody').html(returnedData);
    }
    });
    })
    $('#search').on('blur', function(){
    $('tbody').html('');
    })
</script>
<script type="text/javascript">
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
