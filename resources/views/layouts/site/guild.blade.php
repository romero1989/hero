@extends('layouts.app')

@section('content')
    <div class="well">
        <form class="form-horizontal">
            <fieldset>
                <legend>Guild Mark</legend>
                <div class="form-group">
                    <label for="inputGuildName" class="col-lg-2 control-label">Guild Name</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="inputGuildName" placeholder="Guild name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputGuilImage" class="col-lg-2 control-label">Guild Image</label>
                    <div class="col-lg-10">

                        <div class="input-group">
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file">
                                    Escolher… <input type="file" id="imgInp">
                                </span>
                            </span>
                            <input type="text" class="form-control" readonly>
                        </div>
                        <img id='img-upload'/>

                    </div>
                </div>
                <div class="form-group">
                    <label for="inputCaptcha" class="col-lg-2 control-label">Captcha</label>
                    <div class="col-lg-10">
                        <div class="g-recaptcha" data-sitekey="6LfKURIUAAAAAO50vlwWZkyK_G2ywqE52NU7YO0S"></div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button type="reset" class="btn btn-default">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Criar</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>



@endsection
