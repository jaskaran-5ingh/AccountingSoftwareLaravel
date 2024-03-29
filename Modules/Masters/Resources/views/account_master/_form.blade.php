<div class="row">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Create Account Group <small>Account Group create form</small></h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('name','Name') !!}
                        <strong class="text-danger">*</strong>
                        {!! Form::text('name',null,['class'=>'form-control']) !!}
                        @error('name')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('account_group_id','Select Account Group') !!}
                        <strong class="text-danger">*</strong>
                        {!! Form::select('account_group_id',\Modules\Masters\Entities\AccountGroup::pluck('name','id'),@$model->account_group_id,['class'=>'select2 form-control select']) !!}
                        @error('account_group_id')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('email','Email') !!}
                        <strong class="text-danger">*</strong>
                        {!! Form::email('email',null,['class'=>'form-control']) !!}
                        @error('email')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('phone','Phone') !!}
                        <strong class="text-danger">*</strong>
                        {!! Form::tel('phone',null,['class'=>'form-control']) !!}
                        @error('phone')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('opening_balance','Opening Balance') !!}
                        <strong class="text-danger">*</strong>
                        {!! Form::number('opening_balance',isset($model) ? $model->opening_balance : 0,['class'=>'form-control']) !!}
                        @error('opening_balance')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('account_type','Account Type') !!}
                        <strong class="text-danger">*</strong>
                        {!! Form::select('account_type',['debit' => 'Debit','credit' => 'Credit'],@$mode->account_type,['class'=>'form-control select2']) !!}
                        @error('account_type')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('country_id','Select Country') !!}
                        <strong class="text-danger">*</strong>
                        @if(request()->old('country_id'))
                            {!! Form::select('country_id',\App\Models\Country::pluck('name','id')->prepend('Select', null),request()->old('country_id'),['class'=>'select2 country form-control']) !!}
                        @else
                            {!! Form::select('country_id',\App\Models\Country::pluck('name','id')->prepend('Select', null),@$model->country_id,['class'=>'select2 country form-control']) !!}
                        @endif

                        @error('country_id')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>


                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('state_id','Select State') !!}
                        <strong class="text-danger">*</strong>
                        @if(request()->old('state_id'))
                            {!! Form::select('state_id',\App\Models\State::where('country_id',request()->old('country_id'))->pluck('name','id'),request()->old('state_id'),['class'=>'select2 state form-control']) !!}
                        @else
                            {!! Form::select('state_id',\App\Models\State::where('country_id',@$model->country_id)->pluck('name','id'),@$model->state_id,['class'=>'select2 state form-control']) !!}
                        @endif
                        @error('state_id')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('city_id','Select City') !!}
                        <strong class="text-danger">*</strong>
                        @if(request()->old('city_id'))
                            {!! Form::select('city_id',\App\Models\State::find(request()->old('state_id'))->cities()->pluck('name','id'),request()->old('city_id'),['class'=>'select2 city form-control']) !!}
                        @else
                            @if(isset($model))
                                {!! Form::select('city_id',\App\Models\State::find(@$model->state_id)->cities()->pluck('name','id'),@$model->city_id,['class'=>'select2 city form-control']) !!}
                            @else
                                {!! Form::select('city_id',[],@$model->city_id,['class'=>'select2 city form-control']) !!}
                            @endif
                        @endif

                        @error('city_id')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('address','Address') !!}
                        <strong class="text-danger">*</strong>
                        {!! Form::textarea('address',null,['class'=>'form-control','rows' =>'4']) !!}
                        @error('address')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('dealer_type','Dealer Type') !!}
                        <strong class="text-danger">*</strong>
                        {!! Form::select('dealer_type',['register' => 'Register','unregister' => 'Unregister'],@$model->dealer_type,['class'=>'select2 form-control dealer_type']) !!}
                        @error('dealer_type')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('gst_state_code','GST State Code') !!}
                        <strong class="text-danger">*</strong>
                        {!! Form::text('gst_state_code',null,['class'=>'form-control stateCode']) !!}
                        @error('gst_state_code')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('pincode','PIN Code') !!}
                        {!! Form::number('pincode',null,['class'=>'form-control select']) !!}
                        @error('pincode')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3 gstin_group">
                        {!! Form::label('gstin','GSTIN') !!}
                        {!! Form::text('gstin',null,['class'=>'form-control gstin']) !!}
                        @error('gstin')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('pan','PAN Number') !!}
                        {!! Form::text('pan',null,['class'=>'form-control pan']) !!}
                        @error('pan')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Bank Details <small>Bank Details form</small></h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('bank_name','Bank Name') !!}
                        {!! Form::text('bank_name',null,['class'=>'form-control select']) !!}
                        @error('bank_name')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('branch_name','Bank Branch Name') !!}
                        {!! Form::text('branch_name',null,['class'=>'form-control select']) !!}
                        @error('branch_name')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('account_number','Account Number') !!}
                        {!! Form::text('account_number',null,['class'=>'form-control select']) !!}
                        @error('account_number')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('ifsc_code','IFSC Code') !!}
                        {!! Form::text('ifsc_code',null,['class'=>'form-control select']) !!}
                        @error('ifsc_code')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6 col-sm-12 mb-3">
                        {!! Form::label('account_holder_name','Account Holder Name') !!}
                        {!! Form::text('account_holder_name',null,['class'=>'form-control select']) !!}
                        @error('account_holder_name')
                        <span class="help-block text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@section('scripts')
    <script src="{{ asset('js/account-master.js?ref='.rand(1111,9999)) }}" type="text/javascript"></script>
@endsection
