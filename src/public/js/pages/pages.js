function ajax(type, url, data, callback, datatype = 'json', async = true) {
    var config = {
        type: type,
        async: async,
        dataType: datatype,
        url: url,
    };

    if (type.toLowerCase() === "get") {
        config.params = data;
    } else {
        config.data = data;
    }

    axios(config)
        .then(function (response) {
            if (typeof callback == "object") {
                if (response.data.status === 1) {
                    if (typeof callback.success == "function")
                        callback.success(response.data);
                } else if (data.status === 2) {
                    if (typeof callback.success == "function")
                        callback.success(response.data);
                } else {
                    if (typeof callback.error == "function")
                        callback.error(response.data);
                    else
                        console.error(response.data.text);
                }
            } else {
                if (typeof callback == "function")
                    callback(response.data);
            }

        })
        .catch(function (data) {
            console.log(data);
            if (typeof data.responseText !== undefined)
                alert(data.responseText);
        });
}

/**
 * MODAL DIALOG
 */
// Open modal dialog
function modal_dialog_open(modal, url, data, callback) {
    data = data || "null";

    ajax('post', url, {data: data}, {
        success: function (answer) {
            $(".modal-content", modal).html(answer.html);

            if (callback !== undefined && callback !== null)
                callback();

            $(modal).modal('show');
        }
    });
}
// Очищает содержимое модального окна и отображает загрузку
function modal_dialog_inload(modal) {
    $(".modal-content", modal).html("<div class='modal-body'><p class='text-center text-muted mt-3'><i class='fa fa-spinner fa-spin'></i> Загружаю... Пожалуйста подождите </p></div>");
}
// После закрытия модального окна, очищаем его содержимое
$('#mainModalmd, #mainModallg, #mainModalExt').on('hidden.bs.modal', function () {
    // Уберем фиксированный размер окна.
    $(".modal-dialog", $(this)).removeClass("modal-dialog-scrollable");
    modal_dialog_inload($(this));
});

/**
 * Ссылка для открытия модального окна
 * <a id="antrop_add" class="btn btn-outline-success" href='/ambcard/ambcard/addAnthropometry'
 *          data-url-player_id="<?= $player->id ?>">Добавить</a>
 */
$("body").on('click', '.action-modal-open', function (e) {
    e.preventDefault();
    var url =  $(this).attr("href");
    var modal = $(this).attr('data-modal');
    var data = getData($(this));

    modal_dialog_open($("#"+modal), url, data);
});

/**
 * Получить аттрибуты data для использовании в action действиях
 *
 * @param el
 * @returns {*}
 */
function getData(el)
{
    var attr = $(el).data();
    var data = {};
    // получим данные которые надо добавить в URL
    $.each(attr, function (key, el) {
        if (!key.match(/^url/) && typeof el !== "object") {
            key = key.toLowerCase();
            data[key] = el;
        }
    });
    return data;
}
