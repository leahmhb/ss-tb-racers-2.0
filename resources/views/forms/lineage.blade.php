<legend>Lineage</legend>
<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label for="sire_id" class="col-sm-4 control-label">
        <small>
          <i class="text-danger fa fa-asterisk" data-toggle="tooltip" data-placement="top" title="Required"></i>
        </small>
        Sire
      </label>
      <div class="col-sm-8">
        <select name="sire_id" class="form-control">
          <option> </option>
          @foreach ($domain['sires'] as $s)
          <option value="{{$s['id']}}" @if($horse['sire_id'] == $s['id']) selected @endif>{{$s['call_name']}}</option>
          @endforeach
        </select>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <label for="dam_id" class="col-sm-4 control-label">
        <small>
          <i class="text-danger fa fa-asterisk" data-toggle="tooltip" data-placement="top" title="Required"></i>
        </small>
        Dam
      </label>
      <div class="col-sm-8">
        <select name="dam_id" class="form-control">
          <option> </option>
          @foreach ($domain['dams'] as $d)
          <option value="{{$d['id']}}" @if($horse['dam_id'] == $d['id']) selected @endif>{{$d['call_name']}}</option>
          @endforeach
        </select>
      </div>
    </div>
  </div>
</div>

<div class="form-group">
  <label for="generation" class="col-sm-2 control-label">
    Generation
  </label>
  <div class="col-sm-10">
   <input type="number" name="generation" class="form-control" value="{{ $horse['generation'] }}"  placeholder="0" />
 </div>
</div>