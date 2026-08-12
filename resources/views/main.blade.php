<x-layout title="Portfolio">
    <canvas id="bg-drift"></canvas>
    <section class="ide-section">
        <div class="ide-window">
            <div class="titlebar">
                <span class="dot red"></span>
                <span class="dot yellow"></span>
                <span class="dot green"></span>
                <span class="path">~/portfolio/about</span>
            </div>

            <div class="ide-body">
                <div class="ide-sidebar">
                    <div class="ide-file active" data-file="about">
                        <img src="https://cdn.jsdelivr.net/gh/vscode-icons/vscode-icons/icons/file_type_php.svg"
                            class="file-icon" alt="php">
                        about.php
                    </div>
                    <div class="ide-file" data-file="skills">
                        <img src="https://cdn.jsdelivr.net/gh/vscode-icons/vscode-icons/icons/file_type_json.svg"
                            class="file-icon" alt="json">
                        skills.json
                    </div>
                </div>
                <pre class="ide-code" id="ide-about"><code>&lt;?php

    <span class="k">class</span> <span class="cl">Developer</span>
{
    <span class="k">public</span> $<span class="fn">name</span> = <span class="s">"Utkirbek"</span>;
    <span class="k">public</span> $<span class="fn">role</span> = <span class="s">"Backend Developer"</span>;

    <span class="k">public</span> <span class="k">function</span> <span class="fn">about</span>()
    {
        <span class="k">return</span> <span class="s">"Bu — mening portfolio blogim. Backend qismi Laravel
        (PHP) frameworkida qurilgan: Eloquent ORM, Migration,
        Validation, Middleware, Route Model Binding va Blade
        shablon dvigateli ishlatilgan. Ma'lumotlar PostgreSQL
        bazasida saqlanadi. Fayllarni yuklash Laravel Storage
        tizimi orqali amalga oshiriladi. Butun loyiha Docker
        va Docker Compose yordamida konteynerlashtirilgan.
        Postlar uchun to'liq CRUD, autentifikatsiya va admin
        panel mustaqil qurilgan."</span>;
    }
}</code></pre>

                <pre class="ide-code hidden" id="ide-skills"><code>{
  <span class="k">"php"</span>: <span class="s">"main"</span>,
  <span class="k">"laravel"</span>: <span class="s">"main"</span>,
  <span class="k">"postgresql"</span>: <span class="s">"main"</span>,
  <span class="k">"docker"</span>: <span class="s">"main"</span>,
  <span class="k">"javascript"</span>: <span class="s">"extra"</span>,
  <span class="k">"C"</span>: <span class="s">"extra"</span>,
  <span class="k">"python"</span>: <span class="s">"extra"</span>,
  <span class="k">"tailwind"</span>: <span class="s">"extra"</span>,
  <span class="k">"bootstrap"</span>: <span class="s">"extra"</span>,
  <span class="k">"react.js"</span>: <span class="s">"in progress"</span>,
  <span class="k">"vue.js"</span>: <span class="s">"in progress"</span>

}</code></pre>
            </div>
        </div>
    </section>

    <section class="ide-section">
        <div class="ide-window">
            <div class="titlebar">
                <span class="dot red"></span>
                <span class="dot yellow"></span>
                <span class="dot green"></span>
                <span class="path">~/portfolio/blog/about</span>
            </div>

            <div class="ide-body">
                <div class="ide-sidebar">
                    <div class="ide-file active" data-file="blog-txt">
                        <img src="https://cdn.jsdelivr.net/gh/vscode-icons/vscode-icons/icons/file_type_text.svg"
                            class="file-icon" alt="txt">
                        blog.txt
                    </div>
                </div>

                <pre class="ide-code" id="ide-blog-txt"><code>
<span class="k">title</span>: <span class="s">"Backend yo'lida o'rganganlarim"</span>
<span class="k">author</span>: <span class="s">"Utkirbek"</span>


PHP, Laravel va backend dunyosidagi
tajribalarim, xatolarim va o'rgangan
darslarim — barchasi shu yerda.

<a href="{{ route('posts.index') }}" class="ide-btn">view</a></code></pre>
            </div>
        </div>
    </section>
</x-layout>
