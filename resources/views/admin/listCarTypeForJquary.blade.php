<select class="inputText" style="background-color: white;margin-bottom: 10px"
        name="carType_id_{{$id}}" id="cars">
@foreach ($carType as $index => $carTypeRows)
    <option value="{{$carTypeRows->id}}">{{$carTypeRows->name}}</option>
@endforeach
</select>
