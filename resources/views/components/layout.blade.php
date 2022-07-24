<!DOCTYPE html>
<html lang="ru" class="h-full">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>TestHub</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="h-full">
  <div class="flex flex-col min-h-full overflow-hidden">
    <header class="bg-classicBlue-400 text-classicPink-300 shadow z-10" id="header">
      <div class="container mx-auto">
        <div class="flex justify-between items-center py-2">
          <h1 class="text-6xl">
            <a href="/" class="">TestHub</a>
          </h1>
          <nav class="flex space-x-24 text-lg">
            <ul class="flex space-x-6">
              <li>
                <a href="#" class="hover:text-classicBlue-900"> Подробнее </a>
              </li>
            </ul>
            <ul class="flex space-x-6">
              <li>
                <a href="user/register.html" class="hover:text-classicBlue-900">
                  <i class="fa-solid fa-user-plus"></i>
                  Регистрация
                </a>
              </li>
              <li>
                <a href="user/register.html" class="hover:text-classicBlue-900">
                  <i class="fa-solid fa-arrow-right-to-bracket"></i>
                  Вход
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </header>
    <main class="flex-auto bg-classicPink-400">
      <div class="container mx-auto">
        <h2 class="text-4xl mt-6">{{ $title ?? '' }}</h2>
        <div class="flex my-6">
          <div class="w-3/5">
            {{ $left }}
          </div>
          <div class="w-1/3 space-y-6 mr-0 ml-auto text-sm">
            {{ $right }}
          </div>
        </div>
      </div>
    </main>
    <footer class="bg-classicBlue-400 z-10 shadow-inner">
      <div class="container mx-auto">
        <div class="text-center py-4 text-classicPink-300">
          Copyright &copy; 2022, All Rights Reserved
        </div>
      </div>
    </footer>
  </div>
  {{ $scripts ?? '' }}
</body>

</html>
