@extends('layouts.app')

@section('content')
    <div class="page-content row">
        <!-- Page header -->
        <div class="page-header">
            <div class="page-title">
                <h3> {{ $pageTitle }}
                    <small>{{ $pageNote }}</small>
                </h3>
            </div>
            <ul class="breadcrumb">
                <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
                <li><a href="{{ URL::to('listing?return='.$return) }}">{{ $pageTitle }}</a></li>
                <li class="active"> {{ Lang::get('core.detail') }} </li>
            </ul>
        </div>

        <div class="page-content-wrapper m-t">

            <div class="sbox animated fadeInRight">
                <div class="sbox-title">
                    <a href="{{ URL::to('listing?return='.$return) }}" class="tips btn btn-xs btn-default pull-right" title="{{ Lang::get('core.btn_back') }}"><i class="fa fa-arrow-circle-left"></i>&nbsp;{{ Lang::get('core.btn_back') }}
                    </a>
                    @if($access['is_add'] ==1)
                        <a href="{{ URL::to('listing/update/'.$id.'?return='.$return) }}" class="tips btn btn-xs btn-primary pull-right" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit"></i>&nbsp;{{ Lang::get('core.btn_edit') }}
                        </a>
                    @endif
                </div>
                <div class="sbox-content" style="background:#fff;">

                    <table class="table table-striped table-bordered">
                        <tbody>

                        <tr>
                            <td width='30%' class='label-view text-right'>Id</td>
                            <td>{{ $row->id }} </td>

                        </tr>

                        <tr>
                            <td width='30%' class='label-view text-right'>FullStreetAddress</td>
                            <td>{{ $row->FullStreetAddress }} </td>

                        </tr>

                        <tr>
                            <td width='30%' class='label-view text-right'>City</td>
                            <td>{{ $row->City }} </td>

                        </tr>

                        <tr>
                            <td width='30%' class='label-view text-right'>StateOrProvince</td>
                            <td>{{ $row->StateOrProvince }} </td>

                        </tr>

                        <tr>
                            <td width='30%' class='label-view text-right'>PostalCode</td>
                            <td>{{ $row->PostalCode }} </td>

                        </tr>

                        <tr>
                            <td width='30%' class='label-view text-right'>Country</td>
                            <td>{{ $row->Country }} </td>

                        </tr>

                        <tr>
                            <td width='30%' class='label-view text-right'>DiscloseAddress</td>
                            <td>{{ $row->DiscloseAddress }} </td>

                        </tr>

                        <tr>
                            <td width='30%' class='label-view text-right'>ListPrice</td>
                            <td>{{ $row->ListPrice }} </td>

                        </tr>

                        <tr>
                            <td width='30%' class='label-view text-right'>ListPricePublic</td>
                            <td>{{ $row->ListPricePublic }} </td>

                        </tr>

                        <tr>
                            <td width='30%' class='label-view text-right'>ListingURL</td>
                            <td>{{ $row->ListingURL }} </td>

                        </tr>

                        <tr>
                            <td width='30%' class='label-view text-right'>Bedrooms</td>
                            <td>{{ $row->Bedrooms }} </td>

                        </tr>

                        <tr>
                            <td width='30%' class='label-view text-right'>Bathrooms</td>
                            <td>{{ $row->Bathrooms }} </td>

                        </tr>

                        <tr>
                            <td width='30%' class='label-view text-right'>PropertyType</td>
                            <td>{{ $row->PropertyType }} </td>

                        </tr>

                        <tr>
                            <td width='30%' class='label-view text-right'>ListingKey</td>
                            <td>{{ $row->ListingKey }} </td>

                        </tr>

                        <tr>
                            <td width='30%' class='label-view text-right'>ListingCategory</td>
                            <td>{{ $row->ListingCategory }} </td>

                        </tr>

                        <tr>
                            <td width='30%' class='label-view text-right'>ListingStatus</td>
                            <td>{{ $row->ListingStatus }} </td>

                        </tr>

                        <tr>
                            <td width='30%' class='label-view text-right'>ListingDescription</td>
                            <td>{{ $row->ListingDescription }} </td>

                        </tr>

                        <tr>
                            <td width='30%' class='label-view text-right'>MlsId</td>
                            <td>{{ $row->MlsId }} </td>

                        </tr>

                        <tr>
                            <td width='30%' class='label-view text-right'>MlsName</td>
                            <td>{{ $row->MlsName }} </td>

                        </tr>

                        <tr>
                            <td width='30%' class='label-view text-right'>MlsNumber</td>
                            <td>{{ $row->MlsNumber }} </td>

                        </tr>

                        <tr>
                            <td width='30%' class='label-view text-right'>Photos</td>
                            <td>{{ $row->photos }} </td>

                        </tr>

                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>

@stop