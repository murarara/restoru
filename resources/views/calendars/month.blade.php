<style>
  label{
    cursor: pointer;
    padding:5px;
    border: 1px solid #434343;
    border-radius: 5px;
  }
  input{
    display: none;
  }
  .check_box:checked + .label {
    background-color: orange;
  }
</style>

<ul class="nav nav-tabs" role="tablist">
  
  @for($i = 4; $i <= 15; $i++)
  <li class="nav-item">
    <!-- タブの名前 -->
    <a id="{{$i < 13 ? 'month'.$i.'-tab' : 'month'.($i - 12).'-tab'}}" href="{{$i < 13 ? '#month'.$i :'#month'.($i - 12)}}" class="nav-link {{$i == 4 ? 'active' : ''}}" data-toggle="tab" role="tab" aria-controls="{{$i < 13 ? 'month'.$i : 'month'.($i - 12)}}" aria-selected="{{$i == 4 ? 'true' : 'false'}}">
    @if($i < 13) {{$i}} @else {{$i - 12}} @endif</a>
  </li>
  @endfor
  
</ul>

  <!-- ここまでループ -->
  {{--!!
  <ul class="list-group list-group-flush">
      @foreach($posts as $post)
        @if($post->month == ($i < 13 ? $i : ($i - 12)))
          <li class="list-group-item">{{$post->content}}</li>
        @endif
      @endforeach
  </ul>
  !!--}}
  
  <!-- ここからループ(12回) -->
  
  <?php $i = 4; ?>
  
  <!-- カレンダー -->
  <div class="tab-content">
    @foreach ($allDates ?? array() as $dates)
    <div id="{{$i < 13 ? 'month'.$i : 'month'.($i - 12)}}" class="tab-pane fade {{$i == 4 ? 'show active' : ''}}" role="tabpanel" aria-labelledby="{{$i < 13 ? 'month'.$i.'-tab' : 'month'.($i - 12).'-tab'}}">
      <!--ここにカレンダー-->
      <table class="table table-bordered">
      <thead>
        <tr>
          @foreach (['日', '月', '火', '水', '木', '金', '土'] as $dayOfWeek)
          <th>{{ $dayOfWeek }}</th>
          @endforeach
        </tr>
      </thead>
      <tbody>
        @foreach ($dates as $date)
        @if ($date->dayOfWeek == 0)
        <tr>
        @endif
          <td
            <?php
            foreach($holidays as $holidaysOfYear) {
              foreach($holidaysOfYear as $holiday){
                if (($date->month != $i) || $date->format('Y-m-d') == (string)$holiday || $date->isWeekend()) {
                  echo 'class="bg-secondary"';
                  break;
                }
              }
            }
            ?>
          >
          <input type="checkbox" name="dates[]" class="check_box" 
          <?php 
            if (!(($date->month != $i) || $date->format('Y-m-d') == (string)$holiday || $date->isWeekend())) {
                  echo 'id="'.$date->month.$date->day.'" value="'.$date->format('Y-m-d').'" ';
            }
          ?>
          />
            
          <label class="label" for="{{ $date->month.$date->day }}">{{ $date->day }}</label>
          <br>
          <!-- paid_vacationsに入っていれば表示する -->
          <!-- ↓ $date->format('Y-m-d')と$paid_vacationsのdateが一緒ならば表示してね -->
          <i class="fas fa-user-circle"></i>
          </td>
        @if ($date->dayOfWeek == 6)
        </tr>
        @endif
        @endforeach
      </tbody>
    </table>

      
    </div>
    <?php $i++; 
      if($i >= 13){
        $i -= 12;
      }?>
    @endforeach
  </div>
  
  <div class="tab-pane fade @if($i == 4) active show @endif" 
  id="month @if($i < 13) {{$i++}} @else {{($i++) - 12}} @endif" 
  role="tabpanel" 
  aria-labelledby="@if($i < 13) {{$i}} @else {{$i - 12}} @endif -tab">

  </div>
  
  <!-- ここまでループ -->
  <input class="btn btn-warning" type="submit" value="登録">