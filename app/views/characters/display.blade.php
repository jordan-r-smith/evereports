@extends('master')

@section('content')

<div class="row">
  <div class="col-md-6 col-md-offset-1 text-center">
    <div class="well">
      <table class="table table-responsive">
        <tr>
          @if(gettype($charSheet) != 'string')
          <td>
            <h2>{{ $charSheet['name'] }}</h2>
            <a href="https://zkillboard.com/character/{{ !empty($charSheet['characterID']) ? $charSheet['characterID'] : 'CharacterSheet: Access Required' }}" class="thumbnail" target="_blank">
              <img src="http://image.eveonline.com/Character/{{ $charSheet['characterID'] }}_256.jpg" alt="{{ $charSheet['name'] }}" />
            </a>
          </td>
          <td>
            @if(!empty($charSheet['allianceName']))
            <h5>Alliance:</h5>
            <h4>{{ $charSheet['allianceName'] }}</h4>
            <a href="https://zkillboard.com/alliance/{{ $charSheet['allianceID'] }}" class="thumbnail" target="_blank">
              <img src="http://image.eveonline.com/Alliance/{{ $charSheet['allianceID'] }}_64.png" alt="{{ $charSheet['allianceName'] }}" />
            </a>
            @endif
            <h5>Corporation:</h5>
            <h4>{{ $charSheet['corporationName'] }}</h4>
            <a href="https://zkillboard.com/corporation/{{ $charSheet['corporationID'] }}" class="thumbnail" target="_blank">
              <img src="http://image.eveonline.com/Corporation/{{ $charSheet['corporationID'] }}_64.png" alt="{{ $charSheet['corporationName'] }}" />
            </a>
          </td>
          @else
          <td>
            CharacterSheet: Access Required
          </td>
          @endif
        </tr>
      </table>
    </div>
  </div>
  <div class="col-md-4">
    <div class="well" style="height: 100% !important;">
      <table class="table table-bordered table-responsive" style="margin-bottom: 0;">
        <thead>
          <tr class="label-default">
            <th colspan="2" class="text-center lead">Stats</th>
          </tr>
        </thead>
        <tbody>
          @if(gettype($charSheet) != 'string')
          <tr>
            <td class="text-right">
              <strong>DoB:</strong>
            </td>
            <td>
              {{ $charSheet['DoB'] }}
            </td>
          </tr>
          <tr>
            <td class="text-right">
              <strong>Race:</strong>
            </td>
            <td>
              {{ $charSheet['race'] }}
            </td>
          </tr>
          <tr>
            <td class="text-right">
              <strong>Bloodline:</strong>
            </td>
            <td>
              {{ $charSheet['bloodLine'] }}
            </td>
          </tr>
          <tr>
            <td class="text-right">
              <strong>Ancestry:</strong>
            </td>
            <td>
              {{ $charSheet['ancestry'] }}
            </td>
          </tr>
          <tr>
            <td class="text-right">
              <strong>Clone:</strong>
            </td>
            <td>
              {{ $charSheet['cloneName'] }}
            </td>
          </tr>
          <tr>
            <td class="text-right">
              <strong>Total Skillpoints:</strong>
            </td>
            <td>
              {{ number_format($totalSP) }}
            </td>
          </tr>
          <tr>
            <td class="text-right">
              <strong>Wealth:</strong>
            </td>
            <td>
              {{ number_format($charSheet['balance']) }} ISK
            </td>
          </tr>
          <tr>
            <td class="text-right">
              <strong>Security Status:</strong>
            </td>
            <td>
              {{ number_format($charInfo['securityStatus'], 2) }}
            </td>
          </tr>
          @else
          <tr>
            <td>
              CharacterSheet: Access Required
            </td>
          </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-offset-1 col-md-10">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Skill Queue</h3>
      </div>
      <div class="panel-body">
        <table class="table table-bordered table-responsive" style="margin-bottom: 0;">
          @if(gettype($skillQueue) != 'string')
          <tr>
            <th>Skill Name</th>
            <th>Level</th>
            <th>Time Remaining</th>
            <th>End Time</th>
          </tr>
          @foreach($skillQueue as $skill)
          <?php
          try {
            $typeName = DB::table('invTypes') -> select('typeName') -> where('typeID', $skill['typeID']) -> first();
          } catch (PDOException $e) {
            echo $e;
          }
          ?>
          <tr>
            <td>
              {{ $typeName -> typeName }}
            </td>
            <td><img src="{{ asset('assets/img/level' . $skill['level'] . '.jpg') }}" />
            </td>
            <td id="countdown">
              {{-- $skill['startTime'] --}}
            </td>
            <td>
              {{ $skill['endTime'] }}
            </td>
          </tr>
          <script>
            // set the date we're counting down to
            var target_date = "{{ strtotime($skill['endTime']) * 1000 }}";

            // variables for time units
            var days, hours, minutes, seconds;

            // get tag element
            var countdown = document.getElementById("countdown");

            // update the tag with id "countdown" every 1 second
            setInterval(function() {

              // find the amount of "seconds" between now and target
              var current_date = new Date().getTime();
              var seconds_left = (target_date - current_date) / 1000;

              // do some time calculations
              days = parseInt(seconds_left / 86400);
              seconds_left = seconds_left % 86400;

              hours = parseInt(seconds_left / 3600);
              seconds_left = seconds_left % 3600;

              minutes = parseInt(seconds_left / 60);
              seconds = parseInt(seconds_left % 60);

              // format countdown string + set tag value
              countdown.innerHTML = days + " days, " + hours + ":" + minutes + ":" + seconds + " s";

            }, 1000);
          </script>
          @endforeach
          @else
          <tr>
            <td>
              SkillQueue: Access Required
            </td>
          </tr>
          @endif
        </table>
      </div>
    </div>
  </div>
</div>
@if(gettype($charSheet) != 'string')
@include('characters.skilllist')
@else
<div class="row">
  <div class="col-md-offset-1 col-md-10">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Skills</h3>
      </div>
      <div class="panel-body">
        <p>
          CharacterSheet: Access Required
        </p>
      </div>
    </div>
  </div>
</div>
@endif

@stop

@section('other_includes')

<script src="{{ asset('assets/js/collapse.js') }}"></script>

@stop
