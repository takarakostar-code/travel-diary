<x-layouts.app :title="$diary->title">
    <div class="p-6 max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">
            {{ $diary->title }}
        </h1>

        <p class="mb-2">📍 {{ $diary->location }}</p>
        <p class="mb-4">📅 {{ $diary->travel_date }}</p>

        @if ($diary->image_path)
            <img
                src="{{ asset('storage/' . $diary->image_path) }}"
                alt="旅行写真"
                class="mb-4 max-w-full rounded"
            >
        @endif

        <p class="mb-6">
            {{ $diary->body }}
        </p>

        <div class="flex gap-3">
            <a href="{{ route('diaries.edit', $diary) }}"
               style="display:inline-block; padding:10px 16px; background:#2563eb; color:white; border-radius:6px; text-decoration:none;">
                編集する
            </a>

            <form action="{{ route('diaries.destroy', $diary) }}"
                  method="POST">
                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    style="padding:10px 16px; background:#dc2626; color:white; border:none; border-radius:6px; cursor:pointer;"
                    onclick="return confirm('本当に削除しますか？')">
                    削除する
                </button>
            </form>

            <a href="{{ route('diaries.index') }}">
                一覧に戻る
            </a>
        </div>
    </div>
</x-layouts.app>