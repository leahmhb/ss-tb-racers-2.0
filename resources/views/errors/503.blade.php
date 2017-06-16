@extends('layouts.master', ['title' => '503'])

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">503 Error</h4>
				</div>
				<div class="panel-body">
					<div class="alert alert-danger">
					<p class="text-center">Be right back...</p>      
					</div>
				</div>
				<div class="panel-footer">
					<div class="row">
						<div class="col-sm-4 col-sm-offset-4">           
							<a href="{{ URL::route('index') }}" class="btn btn-default btn-block" role="button">Return to Index</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection