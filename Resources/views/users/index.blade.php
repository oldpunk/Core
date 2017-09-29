@extends('core::layouts.app')

@section('page-title', 'Пользователи')

@section('content')
    <div class="portlet light">
        <div class="portlet-title">

            <div class="actions btn-set">
                <a href="{{ route('users.create') }}" class="btn btn-default"> Добавить</a>
            </div>

            <div class="table-group-actions">
                <select class="bs-select form-control input-medium " >
                    <option value=""><?=_('С отмеченными')?>...</option>
                    <option value="delete"><?=_('Удалить')?></option>
                </select>
                <button class="btn yellow table-group-action-submit" id="deleteListItems" data-mod="#module"><i class="fa fa-check"></i> Выполнить</button>
            </div>
        </div>

        <div class="portlet-body">
            <div class="table-container">
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-hover" >
                        <thead>
                        <tr role="row" class="heading">
                            <th width="1%">
                                <input type="checkbox" class="group-checkable" />
                            </th>
                            <th width="1%">
                                ID
                            </th>

                            <th>Имя</th>

                            <th width="1%">
                                <?=_('Действия')?>
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                            @foreach($users as $user)
                                <tr align="center" class="odd">
                                    <td><input type="checkbox" value="{{ $user->id }}" name="id[]"></td>
                                    <td style="font-size:11px;color:#999;">{{ $user->id }}</td>


                                    <td align="left">
                                        {{ $user->name }}
                                    </td>

                                    <td nowrap="nowrap">
                                        <a class="btn btn-icon-only blue" href="{{ route('users.edit', $user->id) }}" title="<?=_('Редактировать')?>"><i class="fa fa-pencil"></i></a>
                                        <form id="user{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                        </form>
                                        <a href="javascript:del('user{{ $user->id }}')" title="<?=_('Удалить')?>" class="btn btn-icon-only red"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>

@endsection
