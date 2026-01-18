@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="admin-form__content">
    <div class="admin-form__heading">
        <h2>Admin</h2>
    </div>

    <div class="admin-toolbar">
        <form class="search-form" action="{{ route('admin.index') }}" method="get">
            <div class="search-form__item">
                <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="名前やメールアドレスを入力してください">
            </div>
            <div class="search-form__item">
                <select name="gender">
                    <option value="" selected disabled>性別</option>
                    <option value="">全て</option>
                    <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                    <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                    <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
                </select>
            </div>
            <div class="search-form__item">
                <select name="type">
                    <option value="" selected disabled>お問い合わせの種類</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('type') == $category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="search-form__item">
                <input type="date" name="date" value="{{ request('date') }}">
            </div>

            <div class="search-form__actions">
                <button type="submit" class="search-form__btn--search">検索</button>
                <a href="{{ route('admin.index') }}" class="search-form__btn--reset">リセット</a>
            </div>
        </form>

        <div class="admin-sub-toolbar">
            <div class="export-handler">
                <form action="{{ route('admin.export') }}" method="post">
                    @csrf
                    <input type="hidden" name="keyword" value="{{ request('keyword') }}">
                    <input type="hidden" name="gender" value="{{ request('gender') }}">
                    <input type="hidden" name="type" value="{{ request('type') }}">
                    <input type="hidden" name="date" value="{{ request('date') }}">
                    <button type="submit" class="export-btn">エクスポート</button>
                </form>
            </div>

            <div class="pagination-wrapper">
                {{ $contacts->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

    <div class="admin-table">
        <table class="admin-table__inner">
            <thead class="admin-table__head">
                <tr class="admin-table__row">
                    <th class="admin-table__header">お名前</th>
                    <th class="admin-table__header">性別</th>
                    <th class="admin-table__header">メールアドレス</th>
                    <th class="admin-table__header">お問い合わせの種類</th>
                    <th class="admin-table__header"></th>
                </tr>
            </thead>
            <tbody class="admin-table__body">
                @forelse($contacts as $contact)
                <tr class="admin-table__row">
                    <td class="admin-table__item">{{ $contact->last_name }} {{ $contact->first_name }}</td>
                    <td class="admin-table__item">
                        @if($contact->gender == 1) 男性
                        @elseif($contact->gender == 2) 女性
                        @else その他 @endif
                    </td>
                    <td class="admin-table__item">{{ $contact->email }}</td>
                    <td class="admin-table__item">{{ $contact->category->content ?? 'なし' }}</td>
                    <td class="admin-table__item">
                        <a href="#modal-{{ $contact->id }}" class="detail-btn">詳細</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="admin-table__item--empty">該当するデータが見つかりませんでした。</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @foreach($contacts as $contact)
    <div class="modal-window" id="modal-{{ $contact->id }}">
        <div class="modal-content">
            <a href="#" class="modal-close">×</a>
            <table class="modal-table">
                <tr>
                    <th>お名前</th>
                    <td>{{ $contact->last_name }} {{ $contact->first_name}}</td>
                </tr>
                <tr>
                    <th>性別</th>
                    <td>{{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}</td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td>{{ $contact->email }}</td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td>{{ $contact->tel }}</td>
                </tr>
                <tr>
                    <th>住所</th>
                    <td>{{ $contact->address }}</td>
                </tr>
                <tr>
                    <th>建物名</th>
                    <td>{{ $contact->building }}</td>
                </tr>
                <tr>
                    <th>お問い合わせの種類</th>
                    <td>{{ $contact->category->content ?? 'なし' }}</td>
                </tr>
                <tr class="modal-table__row--tall">
                    <th>お問い合わせ内容</th>
                    <td>{{ $contact->detail }}</td>
                </tr>
            </table>
            <form action=" {{ route('admin.delete', ['id' => $contact->id]) }}" method="post" class="delete-form">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn">削除</button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endsection