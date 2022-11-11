<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TODO LIST</title>

    @vite('resources/css/app.css')
</head>

<body>
    {{-- 
  先ほど、コントローラーから渡ってきた変数「todol_lists」は、
  「コレクション型」という型の配列のようなもので渡ってきます。
  このコレクション型を操作するためのメソッドがいくつかあり、
  そのうちの1つである「isNotEmpty」メソッドを使用して、
  コレクションが空じゃないときだけ表示するようにしています。
  ※テーブルにデータが１つもないときは、コレクションは空なので、
  ulタグそのものが表示されません。 
  --}}

    {{-- アットマークから始まるものは、Bladeディレクティブといい、
  Bladeテンプレート内でスクリプトを書く際は、
  基本的にBladeディレクティブを使用 --}}

    @if ($todo_lists->isNotEmpty())
        <div class="cotaniner px-5 mx-auto">
            <ul class="font-medium text-gray-900 bg-white rounded-lg border border-gray-200">
                @foreach ($todo_lists as $item)
                    <li class="py-4 px-5 w-full rounded-t-lg border-b last:border-b-0 border-gray-200">
                        {{-- bladeの場合、
                    変数の出力は波括弧を２つ重ねて
                    以下のように記述 --}}
                        {{ $item->name }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

</body>

</html>
