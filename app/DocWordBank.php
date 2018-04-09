<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocWordBank extends DocWord
{

    public static function DocWordSave($id){


        $doc    = Doc::where('id', $id)->get();
        $doc_tr = Doc_tr::where('doc_id', $id)->get();

        $fullname = 'word';
        $inv_code = $doc[0]->number;

        $file_dir = __DIR__ . '/Helpers/template_bank.docx';

        if (file_exists($file_dir)) {

            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($file_dir);

            $templateProcessor->setValue('FIRM_NAME', $doc[0]->firm->name);
            $templateProcessor->setValue('FIRM_ADDRESS', $doc[0]->firm->address);
            $templateProcessor->setValue('FIRM_PHONE', $doc[0]->firm->phone);
            $templateProcessor->setValue('FIRM_ACCOUNT', $doc[0]->firm->account);
            $templateProcessor->setValue('FIRM_INN', $doc[0]->firm->inn);
            $templateProcessor->setValue('FIRM_KPP', $doc[0]->firm->kpp);
            $templateProcessor->setValue('FIRM_NAMEBANK', $doc[0]->firm->namebank);
            $templateProcessor->setValue('FIRM_BIKBANK', $doc[0]->firm->bikbank);
            $templateProcessor->setValue('FIRM_ACCOUNBANK', $doc[0]->firm->accountbank);
            $templateProcessor->setValue('FIRM_DIREKTOR', $doc[0]->firm->director);
            $templateProcessor->setValue('FIRM_BUH', $doc[0]->firm->buh);

            $templateProcessor->setValue('NUMBER', $doc[0]->number);
            $templateProcessor->setValue('DATE', date('d-m-Y', strtotime($doc[0]->date)));

            $templateProcessor->setValue('CONTRACTOR_NAME', $doc[0]->contractor->name);
            $templateProcessor->setValue('CONTRACTOR_INN', $doc[0]->contractor->inn);

            $templateProcessor->setValue('SPICE_PREFIX', $doc[0]->spice->prefix);
            $templateProcessor->setValue('SPICE_NUMBER', $doc[0]->spice->number);

            $templateProcessor->cloneRow('NUM', count($doc_tr));

            foreach ($doc_tr as $tr) {
                $templateProcessor->setValue('NUM#' . $tr->trnumber, $tr->trnumber);
                $templateProcessor->setValue('SERVICE#' . $tr->trnumber, $tr->service . " " . $tr->route_contractor . " " . $tr->sender);
                $templateProcessor->setValue('DIF#' . $tr->trnumber, $tr->different);
                $templateProcessor->setValue('UNITNAME#' . $tr->trnumber, $tr->unit->name);
                $templateProcessor->setValue('COUNT#' . $tr->trnumber, $tr->count);
                $templateProcessor->setValue('PRICE#' . $tr->trnumber, $tr->price);
                $templateProcessor->setValue('PRICE_TR#' . $tr->trnumber, $tr->total_price_tr);
            }

            $templateProcessor->setValue('TOTAL_PRICE', $doc[0]->total_price);
            $templateProcessor->setValue('COUNT', count($doc_tr));
            $total_price = explode('.', $doc[0]->total_price);
            $templateProcessor->setValue('TOTAL_PRICE_RUB', $total_price[0]);
            $templateProcessor->setValue('TOTAL_PRICE_KOP', $total_price[1]);

            $templateProcessor->setValue('TOTAL_PRICE_TEXT', mb_ucfirst(num2str($doc[0]->total_price)));

            $save_file_name = $fullname . '-' . $inv_code . '-' . date('YmdHis') . '.docx';
            $templateProcessor->saveAs($save_file_name);

            return $save_file_name;

        }
    }

}
