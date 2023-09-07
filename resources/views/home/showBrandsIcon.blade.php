<div class="col-12">
    <div class="col-12">
        <p style="direction: rtl;text-align: center;font-weight: bolder;font-size: 25px;color: #676767">برند خودت رو پیدا کن</p>
    </div>
    <div class="col-12" style="display: flex;justify-content: center">
        <div class="col-8">
            @foreach($brands as $brand)
                <div class="col-2">
                    <a style="color: black" href="/brands/{{$brand->id}}">
                    <div class="col-12" style="text-align: center">
                        <img src="/brand/{{$brand->id}}/1.png" width="100" height="100" alt=" برند{{$brand->name}}}}"/>
                    </div>
                    <div class="col-12" >
                        <p style="text-align: center;margin: 0px 0px 10px 0px">{{$brand->name}}</p>
                    </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
