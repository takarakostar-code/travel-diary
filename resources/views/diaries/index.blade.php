<x-layouts.app :title="'旅行日記'">
    <div class="p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">旅行日記</h1>

            <a href="{{ route('diaries.create') }}"
               style="display:inline-block; padding:10px 16px; background:#2563eb; color:white; border-radius:6px; text-decoration:none;">
                新しい日記を書く
            </a>
        </div>

        <form action="{{ route('diaries.index') }}" method="GET" class="mb-6">
            <div style="display:flex; gap:8px;">
                <input
                    type="text"
                    name="keyword"
                    value="{{ $keyword ?? '' }}"
                    placeholder="タイトル・場所・本文を検索"
                    style="flex:1; padding:10px; border:1px solid #ccc; border-radius:6px;"
                >

                <button
                    type="submit"
                    style="padding:10px 16px; background:#2563eb; color:white; border:none; border-radius:6px; cursor:pointer;">
                    検索
                </button>

                <a
                    href="{{ route('diaries.index') }}"
                    style="padding:10px 16px; border:1px solid #ccc; border-radius:6px; text-decoration:none;">
                    クリア
                </a>
            </div>
        </form>

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 rounded">
                {{ session('success') }}
            </div>
        @endif

        @forelse ($diaries as $diary)
            <div class="mb-4 p-4 border rounded">
                <h2 class="text-xl font-semibold">
                    <a href="{{ route('diaries.show', $diary) }}">
                        {{ $diary->title }}
                    </a>
                </h2>

                <p class="mt-2">📍 {{ $diary->location }}</p>
                <p>📅 {{ $diary->travel_date }}</p>

                <p class="mt-3">
                    {{ Str::limit($diary->body, 100) }}
                </p>
            </div>
        @empty
            <p>まだ旅行日記がありません。</p>
        @endforelse
    </div>
</x-layouts.app>