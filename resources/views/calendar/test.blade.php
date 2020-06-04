<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>カレンダーのテスト</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
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
    </head>
    <body>
        <div class="container">
            <?php 
                /**
                 * ライブラリを読み込む
                 */
                use Carbon\Carbon;
                
                $currentMonth = 5;
                $currentYear = 2020;
                $dates = getCalendarDates(2020, $currentMonth);
                
                /**
                 * カレンダーのデータを作成する
                 */
                function getCalendarDates($year, $month)
                {
                    $dateStr = sprintf('%04d-%02d-01', $year, $month);
                    $date = new Carbon($dateStr);
                    // カレンダーを四角形にするため、前月となる左上の隙間用のデータを入れるためずらす
                    $date->subDay($date->dayOfWeek);
                    // 同上。右下の隙間のための計算。
                    $count = 31 + $date->dayOfWeek;
                    $count = ceil($count / 7) * 7;
                    $dates = [];
            
                    for ($i = 0; $i < $count; $i++, $date->addDay()) {
                        // copyしないと全部同じオブジェクトを入れてしまうことになる
                        $dates[] = $date->copy();
                    }
                    return $dates;
                }
                
                /**
                 * 日本の祝日
                 */
                use \Yasumi\Yasumi;

                $holidays = Yasumi::create('Japan', (string)$currentYear, 'ja_JP');
                foreach($holidays as $holiday) {
                    echo $holiday . ':' . $holiday->getName() . PHP_EOL;
                }
            ?>
            <form action="#" method="GET">
              <input class="btn btn-warning" type="submit" value="やばい">
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
                    @if ($date->month != $currentMonth)
                    class="bg-secondary"
                    @endif
                    @foreach ($holidays as $holiday)
                    @if ($date === $holiday)
                    class="bg-warning"
                    @endif
                  @endforeach
                  >
        
                  <input type="checkbox" name="dates[]" class="check_box" id="{{ $date->month.$date->day }}" value="{{ $date->month.$date->day }}" />
                  <label class="label" for="{{ $date->month.$date->day }}">{{ $date->day }}</label>
                  </td>
                @if ($date->dayOfWeek == 6)
                </tr>
                @endif
                @endforeach
              </tbody>
            </table>
            </form>
            <h1>
                <?php
                if(isset($_GET['dates']) && is_array($_GET['dates'])) { 
                    
                    foreach($_GET['dates'] as $v) {
                        
                        echo "{$v},";
                    }
                    //echo $res;
                }
                ?>
            </h1>
        </div>
    </body>
        
</html>
