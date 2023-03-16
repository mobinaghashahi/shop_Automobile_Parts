@extends('admin.menu')
@section('content')
<div class="main">
    <div class="col-12" style="text-align: center;padding-top: 15px;">
        <a style="background-color: #363636;padding: 10px;border-radius: 5px;color: white">افزودن محصول جدید</a>
    </div>
    <div class="blockOfInputs">
        <div class="col-6 titleTextInput" style="display: flex;justify-content: center">
            <div class="col-4">
                <input style="text-align: center" class="inputText" placeholder="نام محصول">
            </div>
        </div>
        <div class="col-6 titleTextInput" style="display: flex;justify-content: center">
            <div class="col-4">
                <input style="text-align: center" class="inputText" placeholder="قیمت">
            </div>
        </div>
        <div class="col-6 titleTextInput" style="display: flex;justify-content: center">
            <div class="col-4">
                <input style="text-align: center" class="inputText" placeholder="تعداد">
            </div>
        </div>
        <div class="col-6 titleTextInput" style="display: flex;justify-content: center">
            <div class="col-4">
                <textarea class="inputText" style="text-align: center" placeholder="توضیحات"></textarea>
            </div>
        </div>
        <div class="col-6 titleTextInput" style="display: flex;justify-content: center">
            <div class="col-4" style="text-align: center">
                <label>برند</label>
                <select class="inputText" style="background-color: white" name="cars" id="cars">
                    <option value="volvo">Volvo</option>
                    <option value="saab">Saab</option>
                    <option value="mercedes">Mercedes</option>
                    <option value="audi">Audi</option>
                </select>
            </div>
        </div>
        <div class="col-6 titleTextInput" style="display: flex;justify-content: center">
            <div class="col-4" style="text-align: center">
                <label>نوع ماشین</label>
                <select class="inputText" style="background-color: white" name="cars" id="cars">
                    <option value="volvo">Volvo</option>
                    <option value="saab">Saab</option>
                    <option value="mercedes">Mercedes</option>
                    <option value="audi">Audi</option>
                </select>
            </div>
        </div>
        <div class="col-6 titleTextInput" style="display: flex;justify-content: center">
            <div class="col-4" style="text-align: center">
                <label>تخفیف</label>
                <select class="inputText" style="background-color: white" name="cars" id="cars">
                    <option value="volvo">Volvo</option>
                    <option value="saab">Saab</option>
                    <option value="mercedes">Mercedes</option>
                    <option value="audi">Audi</option>
                </select>
            </div>
        </div>
        <div class="col-6 titleTextInput" style="display: flex;justify-content: center">
            <div class="col-4" style="text-align: center">
                <label>دسته بندی</label>
                <select class="inputText" style="background-color: white" name="cars" id="cars">
                    <option value="volvo">Volvo</option>
                    <option value="saab">Saab</option>
                    <option value="mercedes">Mercedes</option>
                    <option value="audi">Audi</option>
                </select>
            </div>
        </div>
        <div class="col-12" style="padding-top: 10px;display: flex;justify-content: center">
            <div class="col-3">
                <input class="inputSubmit" type="submit" value="افزودن">
            </div>
        </div>
    </div>
</div>
@endsection
