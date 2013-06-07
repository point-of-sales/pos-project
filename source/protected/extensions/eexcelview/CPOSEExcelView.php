<?php

Yii::import('zii.widgets.grid.CGridView');
/**
 * User: ${Cristazn}
 * Date: 4/8/13
 * Time: 4:25 PM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980
 */
class CPOSEExcelView extends EExcelView
{


    // PHP Excel Path
    public static $phpExcelPathAlias = 'ext.phpexcel.Classes.PHPExcel';

    //the PHPExcel object
    public static $objPHPExcel = null;
    public static $activeSheet = null;
    public static $thongTinCongTy = null;

    //Document properties
    public $creator = 'Point Of Sale System';
    public $title = null;
    public $subject = 'No-Subject';
    public $description = '';
    public $category = '';
    public $brandName = '';
    public $documentTitle = '';
    public $template = null;
    public $fromDate = null;
    public $toDate = null;

    public function init()
    {
        if (!isset($this->title))
            $this->title = Yii::app()->getController()->getPageTitle();

        parent::init();

        //Autoload fix
        spl_autoload_unregister(array('YiiBase', 'autoload'));
        Yii::import(self::$phpExcelPathAlias, true);
        self::$objPHPExcel = new PHPExcel();
        self::$activeSheet = self::$objPHPExcel->getActiveSheet();
        spl_autoload_register(array('YiiBase', 'autoload'));
        $tmp = ThongTinCongTy::model()->findAll();
        self::$thongTinCongTy = $tmp[0];

        // Creating a workbook
        $properties = self::$objPHPExcel->getProperties();
        $properties
            ->setTitle($this->title)
            ->setCreator($this->creator)
            ->setSubject($this->subject)
            ->setDescription($this->description)
            ->setCategory($this->category);

        //$this->initColumns();

    }

    public function renderCompanyInfoHeader($startColumn = 'A', $row = 1)
    {
        //find end column for merge cell
        $endColumn = $this->columnName($this->columnIndex($startColumn) + 2);

        self::$activeSheet->setCellValue($startColumn . $row, self::$thongTinCongTy->ten_cong_ty);
        $coordinate = $startColumn . $row . ':' . $endColumn . $row;
        $this->setCellFormatStyle($startColumn, $row, array('bold' => true, 'italic' => true, 'size' => 10), null, PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        self::$activeSheet->mergeCells($coordinate);
        self::$activeSheet->getColumnDimension($startColumn)->setWidth(14);


        self::$activeSheet->setCellValue($startColumn . (++$row), 'ĐC: ' . self::$thongTinCongTy->dia_chi);
        $coordinate = $startColumn . $row . ':' . $endColumn . $row;
        $this->setCellFormatStyle($startColumn, $row, array('bold' => true, 'italic' => true, 'size' => 10), null, PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        self::$activeSheet->mergeCells($coordinate);

        self::$activeSheet->setCellValue($startColumn . (++$row), 'ĐT: ' . self::$thongTinCongTy->dien_thoai);
        $coordinate = $startColumn . $row . ':' . $endColumn . $row;
        $this->setCellFormatStyle($startColumn, $row, array('bold' => true, 'italic' => true, 'size' => 10), null, PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        self::$activeSheet->mergeCells($coordinate);
        // add branch name here

    }

    public function renderCreatedDate($startColumn = null, $row = 4)
    {
        if (!isset($startColumn)) {
            $maxWidth = $this->getMaxWidth();
            $columnName = $this->columnName($maxWidth - 1);
            self::$activeSheet->setCellValue($columnName . $row, 'Ngày tạo:' . date('d-m-Y', time()));
        } else {
            self::$activeSheet->setCellValue($startColumn . $row, 'Ngày tạo:' . date('d-m-Y', time()));
        }
    }

    public function renderDocumentNo($startColumn = null, $row = 5)
    {
        if (!isset($startColumn)) {
            $maxWidth = $this->getMaxWidth();
            $columnName = $this->columnName($maxWidth - 1);
            self::$activeSheet->setCellValue($columnName . $row, 'Số:.......................');
        } else {
            self::$activeSheet->setCellValue($startColumn . $row, 'Số:.......................');
        }
    }

    public function renderResponsibleEmployees($startColumn = null, $row = 9)
    {

    }

    public function renderDocumentTitle($startColumn = 'A', $row = 7)
    {

        if (isset($this->documentTitle)) {
            $maxWidth = $this->getMaxWidth();
            $endColumn = $this->columnName($maxWidth);
            $coordinate = "{$startColumn}{$row}:{$endColumn}{$row}";
            self::$activeSheet->setCellValue($startColumn . $row, PHPExcel_Calculation_TextData::UPPERCASE($this->documentTitle));
            self::$activeSheet->mergeCells($coordinate);
            $this->setCellFormatStyle($startColumn, $row, array('bold' => true, 'size' => 16));
        }
    }

    public function getMaxWidth()
    {
        return count($this->columns);
    }


    public function renderCompanyInfoFooter()
    {

    }


    public function renderTitleColumns($startColumn = null, $row = 10)
    {

        //custom column and row
        if (isset($startColumn)) {
            $i = $this->columnIndex($startColumn);
        } else {
            $i = 0;
        }

        foreach ($this->columns as $n => $column) {
            ++$i;
            if ($column->name !== null && $column->header === null) {
                if ($column->grid->dataProvider instanceof CActiveDataProvider)
                    $head = $column->grid->dataProvider->model->getAttributeLabel($column->name);
                else
                    $head = $column->name;
            } else
                $head = trim($column->header) !== '' ? $column->header : $column->grid->blankDisplay;

            if ($head == 'ID' || $head == 'id')
                $head = 'Số TT'; // replace ID with So TT

            self::$activeSheet->setCellValue($this->columnName($i) . $row, $head);
            $this->setCellFormatStyle($this->columnName($i), $row, array('bold' => true), 'pro', PHPExcel_Style_Alignment::HORIZONTAL_CENTER, array('top' => true, 'right' => true, 'bottom' => true, 'left' => true), PHPExcel_Style_Border::BORDER_MEDIUM);
        }


    }

    // Main consuming function, apply every optimization you could think of
    public function renderBody($startColumn = null, $row = 11)
    {

        if ($this->disablePaging) //if needed disable paging to export all data
        $this->enablePagination = false;

        self::$data = $this->dataProvider->getData();
        $n = count(self::$data);


        if ($n > 0)
            for ($rowNo = 0; $rowNo < $n; ++$rowNo) {
                $this->renderRow($rowNo, $startColumn, $row);

            }
    }

    public function renderRow($rowNo, $startColumn, $row)
    {
        if (isset($startColumn)) {
            $i = $this->columnIndex($startColumn);
        } else {
            $i = 0;
        }

        foreach ($this->columns as $n => $column):


            if ($column->value !== null) {

                $value = $this->evaluateExpression($column->value, array('row' => $rowNo, 'data' => self::$data[$rowNo]));
            } else if ($column->name !== null) {
                //edited by francis to support relational dB tables
                $condition = explode(";", $column->name);
                $value = $column->name;

                // I don't understand this piece of code (the conditions and all that stuff), when these conditions will meet?
                // Francis, if you see this code ever again, please comment
                $countCondition = count($condition);

                if ($countCondition == 6 || $countCondition == 5):
                    switch ($countCondition):
                        case 6:
                            $cond1 = $this->dataProcess($condition[0], $rowNo);
                            if ($condition[3] == 'true')
                                $cond2 = $condition[2];
                            else
                                $cond2 = $this->dataProcess($condition[2], $rowNo);

                            $cond3 = $this->dataProcess($condition[4], $rowNo);
                            $cond4 = $this->dataProcess($condition[5], $rowNo);
                            break;
                        case 5:
                            $cond1 = $this->dataProcess($condition[0], $rowNo);
                            $cond2 = $this->dataProcess($condition[2], $rowNo);
                            $cond3 = $this->dataProcess($condition[3], $rowNo);
                            $cond4 = $this->dataProcess($condition[4], $rowNo);
                            break;
                        default:
                            break;
                    endswitch;

                    switch ($condition[1]):
                        case '==':
                            $value = ($cond1 == $cond2) ? $cond3 : $cond4;
                            break;
                        case '!=':
                            $value = ($cond1 != $cond2) ? $cond3 : $cond4;
                            break;
                        case '<=':
                            $value = ($cond1 <= $cond2) ? $cond3 : $cond4;
                        case '>=':
                            $value = ($cond1 >= $cond2) ? $cond3 : $cond4;
                            break;
                        case '<':
                            $value = ($cond1 < $cond2) ? $cond3 : $cond4;
                        case '>':
                            $value = ($cond1 > $cond2) ? $cond3 : $cond4;
                        default:
                            break;
                    endswitch; elseif ($countCondition != 1):
                    $value = ''; else:
                    $value = $this->dataProcess($column->name, $rowNo);
                endif;
            }

            //date edited francis
            $dateF = explode("-", $value);
            $c1 = count($dateF);

            if ($c1 == 3 && $dateF[0] < 9000 && $dateF[1] < 13 && $dateF[2] < 32) //{}
            $value = $dateF[2] . '/' . $dateF[1] . '/' . $dateF[0];
            //end of date

            $value = $value === null ? "" : $column->grid->getFormatter()->format($value, $column->type);

            // Write to the cell (and advance to the next)
            if ($column->name == 'id' || $column->name == 'ID' || $column->name == 'STT') {
                self::$activeSheet->setCellValue($this->columnName(++$i) . ($row + $rowNo), ($rowNo + 1));
                //$this->setCellFormatStyle($this->columnName($i),$row+$rowNo,array(),null,PHPExcel_Style_Alignment::HORIZONTAL_CENTER,array('top'=>true,'right'=>true,'bottom'=>true,'left'=>true,PHPExcel_Style_Border::BORDER_DASHED));
                $this->setCellFormatStyle($this->columnName($i), $row + $rowNo, array(), null, PHPExcel_Style_Alignment::HORIZONTAL_CENTER, array('top' => true, 'right' => true, 'bottom' => true, 'left' => true), PHPExcel_Style_Border::BORDER_DASHED);
            } else {
                self::$activeSheet->setCellValue($this->columnName(++$i) . ($row + $rowNo), $value);

                $this->setCellFormatStyle($this->columnName($i), $row + $rowNo, array(), null, PHPExcel_Style_Alignment::HORIZONTAL_GENERAL, array('top' => true, 'right' => true, 'bottom' => true, 'left' => true), PHPExcel_Style_Border::BORDER_DASHED);
            }
        endforeach;

        // As we are done with this row we DONT need this specific record
        unset(self::$data[$rowNo]);
    }

    public function dataProcess($name, $row)
    {
        // Separate name (eg person.code into array('person', 'code'))
        $separated_name = explode(".", $name);

        // Count
        $n = count($separated_name);

        // Create a copy of  the data row. Now we can "dive" trough the array until we reach the desired value
        // (because is nested)
        $aux = self::$data[$row]; //if n is greater than zero, we will loop, if not, $aux actually holds the desired value

        for ($i = 0; $i < $n; ++$i)
            $aux = $aux[$separated_name[$i]]; // We keep a deeper reference each time

        return $aux;
    }


    public function setDefaultStyle()
    {
        self::$objPHPExcel->getDefaultStyle()->getFont()->setName('Times New Roman');
        self::$objPHPExcel->getDefaultStyle()->getFont()->setSize(12);
    }

    /*
     function set format for cell
     $columnStartName : column Name such as : 'A', 'B', 'C'.
     $row : row init to write
     ...
     $borderPosition : array('top','right','bottom','left').
     $borderStyle : line style for cell default is thin
     */

    public function setCellFormatStyle($columnStartName, $row, $textStyles = array(), $bgColor = null, $align = PHPExcel_Style_Alignment::HORIZONTAL_CENTER, $borderPosition = array('top' => false, 'right' => false, 'bottom' => false, 'left' => false), $borderStyle = PHPExcel_Style_Border::BORDER_NONE)
    {
        $bold = false;
        $italic = false;
        $underline = PHPExcel_Style_Font::UNDERLINE_NONE;
        $size = 12;
        $textColor = PHPExcel_Style_Color::COLOR_BLACK;
        foreach ($textStyles as $key => $value) {
            if ($key == 'bold')
                $bold = $value;
            if ($key == 'italic')
                $italic = true;
            if ($key == 'underline')
                $underline = true;
            if ($key == 'size')
                $size = $value;
            if ($key == 'color')
                $textColor = $value;
        }


        // fill color for background
        switch ($bgColor) {
            case 'red':
            {
                $bgColor = PHPExcel_Style_Color::COLOR_RED;
                break;
            }
            case 'green':
            {
                $bgColor = PHPExcel_Style_Color::COLOR_GREEN;
                break;
            }
            case 'blue':
            {
                $bgColor = PHPExcel_Style_Color::COLOR_BLUE;
                break;
            }

            case 'pro':
            {
                $bgColor = '#DDDBD1';
                break;
            }
            case 'gent':
            {
                $bgColor = '#C4D8E2';
                break;
            }
        }

        $styleArray = array(
            'font' => array(
                'bold' => $bold,
                'italic' => $italic,
                'underline' => $underline,
                'size' => $size,
                'color' => array('rgb' => $textColor),
            ),
            'borders' => array(
                'top' => ($borderPosition['top']) ? array('style' => $borderStyle) : array('style' => PHPExcel_Style_Border::BORDER_NONE),
                'right' => ($borderPosition['right']) ? array('style' => $borderStyle) : array('style' => PHPExcel_Style_Border::BORDER_NONE),
                'bottom' => ($borderPosition['bottom']) ? array('style' => $borderStyle) : array('style' => PHPExcel_Style_Border::BORDER_NONE),
                'left' => ($borderPosition['left']) ? array('style' => $borderStyle) : array('style' => PHPExcel_Style_Border::BORDER_NONE),
            ),

            'alignment' => array(
                'horizontal' => $align,
            ),
            'fill' => array(
                'type' => ($bgColor != null) ? PHPExcel_Style_Fill::FILL_SOLID : PHPExcel_Style_Fill::FILL_NONE,
                'color' => array('rgb' => $bgColor)
            ),
        );

        // apply all style arrray
        self::$objPHPExcel->getActiveSheet()->getStyle($columnStartName . $row)->applyFromArray($styleArray);
    }

    public function fixColumnsWidth()
    {
        self::$activeSheet->getColumnDimension("A")->setWidth(6);
        self::$activeSheet->getColumnDimension("B")->setWidth(14);
        self::$activeSheet->getColumnDimension("C")->setWidth(13);
        self::$activeSheet->getColumnDimension("D")->setWidth(13);
        self::$activeSheet->getColumnDimension("E")->setWidth(13);
        self::$activeSheet->getColumnDimension("I")->setWidth(10);
        self::$activeSheet->getColumnDimension("J")->setWidth(14);
        self::$activeSheet->getColumnDimension("K")->setWidth(15);

    }


    public function renderPhieuNhapInfo($startColumn = null, $row = 6)
    {
        //custom column and row
        if (isset($startColumn)) {
            $i = $this->columnIndex($startColumn);
        } else {
            $i = 0;
        }
        $tmp = $this->dataProvider->getData();
        $chiTietPhieuNhap = $tmp[0];
        $maChungTu = $chiTietPhieuNhap->phieuNhap->chungTu->ma_chung_tu;
        $ngayLap = $chiTietPhieuNhap->phieuNhap->chungTu->ngay_lap;
        $nhanVien = $chiTietPhieuNhap->phieuNhap->chungTu->nhanVien->ho_ten;
        $chiNhanhNhap = $chiTietPhieuNhap->phieuNhap->chungTu->chiNhanh->ten_chi_nhanh;
        $chiNhanhXuat = $chiTietPhieuNhap->phieuNhap->chiNhanhXuat->ten_chi_nhanh;

        self::$activeSheet->setCellValue('B8', Yii::t('viLib', 'Voucher code'));
        self::$activeSheet->setCellValue('C8', $maChungTu);
        self::$activeSheet->setCellValue('B9', Yii::t('viLib', 'Created date'));
        self::$activeSheet->setCellValue('C9', $ngayLap);
        self::$activeSheet->setCellValue('B10', Yii::t('viLib', 'Employee'));
        self::$activeSheet->setCellValue('C10', $nhanVien);
        self::$activeSheet->setCellValue('B11', Yii::t('viLib', 'Export branch'));
        self::$activeSheet->setCellValue('C11', $chiNhanhXuat);
        self::$activeSheet->setCellValue('B12', Yii::t('viLib', 'Import branch'));
        self::$activeSheet->setCellValue('C12', $chiNhanhNhap);
        self::$activeSheet->setCellValue('B13', Yii::t('viLib', 'Shipper'));

    }
    
    public function renderHoaDonBanHangInfo($startColumn = null, $row = 6)
    {
        //custom column and row
        if (isset($startColumn)) {
            $i = $this->columnIndex($startColumn);
        } else {
            $i = 0;
        }
        $tmp = $this->dataProvider->getData();
        $chiTietHoaDonBan = $tmp[0];
        $hoaDonBanHang = $chiTietHoaDonBan->hoaDonBanHang;
        $khachHang = $chiTietHoaDonBan->hoaDonBanHang->khachHang;
        
        $maChungTu = $hoaDonBanHang->chungTu->ma_chung_tu;
        $ngayLap = $hoaDonBanHang->chungTu->ngay_lap;
        $giam_gia = $hoaDonBanHang->chiet_khau;
        $nhanVien = $hoaDonBanHang->chungTu->nhanVien->ho_ten;
        $chi_nhanh = $hoaDonBanHang->chungTu->chiNhanh->ten_chi_nhanh;
        $tri_gia = $hoaDonBanHang->chungTu->tri_gia;
        
        $ma_khach_hang = $khachHang->ma_khach_hang;
        $ten_khach_hang = $khachHang->ho_ten;
        $dia_chi = $khachHang->dia_chi;
        $dien_thoai = $khachHang->dien_thoai;
        $loai_khach_hang = $khachHang->loaiKhachHang->ten_loai;
        

        self::$activeSheet->setCellValue('B8', Yii::t('viLib', 'Voucher code'));
        self::$activeSheet->setCellValue('C8', $maChungTu);
        self::$activeSheet->setCellValue('B9', Yii::t('viLib', 'Created date'));
        self::$activeSheet->setCellValue('C9', $ngayLap);
        self::$activeSheet->setCellValue('B10', 'Nhân viên lập hóa đơn');
        self::$activeSheet->setCellValue('C10', $nhanVien);
        self::$activeSheet->setCellValue('B11', 'Chi nhánh bán');
        self::$activeSheet->setCellValue('C11', $chi_nhanh);
        //self::$activeSheet->setCellValue('B12', 'Trị giá');
        //self::$activeSheet->setCellValue('C12', $tri_gia);
        //self::$activeSheet->setCellValue('B12', 'Trị giá');
        //self::$activeSheet->setCellValue('C12', $tri_gia);
        
        self::$activeSheet->setCellValue('D8', 'Mã khách hàng');
        self::$activeSheet->setCellValue('E8', $ma_khach_hang);
        self::$activeSheet->setCellValue('D9', 'Tên khách hàng');
        self::$activeSheet->setCellValue('E9', $ten_khach_hang);
        self::$activeSheet->setCellValue('D10', 'Điện thoại');
        self::$activeSheet->setCellValue('E10', $dien_thoai);
        self::$activeSheet->setCellValue('D11', 'Địa chỉ');
        self::$activeSheet->setCellValue('E11', $dia_chi);
        self::$activeSheet->setCellValue('D12', 'Loại khách hàng');
        self::$activeSheet->setCellValue('E12', $loai_khach_hang);
        //self::$activeSheet->setCellValue('D13', 'Giảm giá');
        //self::$activeSheet->setCellValue('E13', $giam_gia);

    }

    public function renderPhieuXuatInfo($startColumn = null, $row = 6)
    {
        //custom column and row
        if (isset($startColumn)) {
            $i = $this->columnIndex($startColumn);
        } else {
            $i = 0;
        }
        $tmp = $this->dataProvider->getData();
        $chiTietPhieuXuat = $tmp[0];
        $maChungTu = $chiTietPhieuXuat->phieuXuat->chungTu->ma_chung_tu;
        $ngayLap = $chiTietPhieuXuat->phieuXuat->chungTu->ngay_lap;
        $nhanVien = $chiTietPhieuXuat->phieuXuat->chungTu->nhanVien->ho_ten;
        $chiNhanhXuat = $chiTietPhieuXuat->phieuXuat->chungTu->chiNhanh->ten_chi_nhanh;
        $chiNhanhNhap = $chiTietPhieuXuat->phieuXuat->chiNhanhNhap->ten_chi_nhanh;

        self::$activeSheet->setCellValue('B8', Yii::t('viLib', 'Voucher code'));
        self::$activeSheet->setCellValue('C8', $maChungTu);
        self::$activeSheet->setCellValue('B9', Yii::t('viLib', 'Created date'));
        self::$activeSheet->setCellValue('C9', $ngayLap);
        self::$activeSheet->setCellValue('B10', Yii::t('viLib', 'Employee'));
        self::$activeSheet->setCellValue('C10', $nhanVien);
        self::$activeSheet->setCellValue('B11', Yii::t('viLib', 'Export from : '));
        self::$activeSheet->setCellValue('C11', $chiNhanhXuat);
        self::$activeSheet->setCellValue('B12', Yii::t('viLib', 'Import branch'));
        self::$activeSheet->setCellValue('C12', $chiNhanhNhap);
        self::$activeSheet->setCellValue('B13', Yii::t('viLib', 'Shipper'));

    }

    public function renderTotal($startColumn = null, $rowStartColumnTitles = 0)
    {
        //custom column and row
        if (isset($startColumn)) {
            $startIndex = $this->columnIndex($startColumn);
        } else {
            $startIndex = 0;
        }

        $tmp = $this->dataProvider->getData();
        $toTal = 0;
        foreach ($tmp as $t) {
            $arr = $t->getAttributes();
            $gia = 0;
            foreach ($arr as $key => $value) {
                if (substr($key, 0, 4) == 'gia_') {
                    $gia = $value;
                    break;
                }
            }
            $toTal = $toTal + $t->so_luong * $gia;
        }
        $rowNum = count($tmp) + 1 + $rowStartColumnTitles;

        $columnNum = count($this->columns);
        $endIndex = $startIndex + $columnNum-1;
        $endColumn = $this->columnName($endIndex);
        self::$activeSheet->setCellValue($startColumn . $rowNum, Yii::t('viLib', 'Total'));
        self::$activeSheet->setCellValue($this->columnName($endIndex + 1) . $rowNum, $toTal);
        $this->setCellFormatStyle($startColumn, $rowNum, array('bold' => true), 'C1B5A5', PHPExcel_Style_Alignment::HORIZONTAL_CENTER, array('top' => true, 'right' => true, 'bottom' => true, 'left' => true), PHPExcel_Style_Border::BORDER_THIN);
        $this->setCellFormatStyle($this->columnName($endIndex + 1), $rowNum, array('bold' => true), 'F2EF87 ', PHPExcel_Style_Alignment::HORIZONTAL_RIGHT, array('top' => true, 'right' => true, 'bottom' => true, 'left' => true), PHPExcel_Style_Border::BORDER_THIN);
        self::$activeSheet->mergeCells($startColumn . $rowNum . ":" . $endColumn . $rowNum);

        // render text of amount
        $amountText = Helpers::readNumber($toTal);
        self::$activeSheet->setCellValue($startColumn . ($rowNum+2), Yii::t('viLib','Amount in text') . ' : ' . $amountText);
        $this->setCellFormatStyle($startColumn, $rowNum+2, array('italic' => true),'', PHPExcel_Style_Alignment::HORIZONTAL_LEFT, array('top' => true, 'right' => true, 'bottom' => true, 'left' => true), PHPExcel_Style_Border::BORDER_NONE);
        self::$activeSheet->mergeCells($startColumn . ($rowNum+2) . ":" . $endColumn . ($rowNum+2));
    }

    public function renderImportExportTotal($startColumn = null, $rowStartColumnTitles = 0)
    {
        //custom column and row

        if (isset($startColumn)) {
            $startIndex = $this->columnIndex($startColumn);
        } else {
            $startIndex = 0;
        }

        $tmp = $this->dataProvider->getData();
        $tong_ton_dau_ky = 0;
        $tong_nhap_trong_ky = 0;
        $tong_xuat_trong_ky = 0;
        $tong_ban_trong_ky = 0;
        $tong_tra_trong_ky = 0;
        $tong_thuc_ton = 0;
        $position = 0;
        $endTotalIndex = array(); //end index cua cot Tong Cong


        foreach ($tmp as $t) {
            $tong_ton_dau_ky = $tong_ton_dau_ky + $t->ton_dau_ky;
            $tong_nhap_trong_ky = $tong_nhap_trong_ky + $t->so_luong_nhap;
            $tong_ban_trong_ky = $tong_ban_trong_ky + $t->so_luong_ban;
            $tong_xuat_trong_ky = $tong_xuat_trong_ky + $t->so_luong_xuat;
            $tong_tra_trong_ky = $tong_tra_trong_ky + $t->so_luong_tra;
            $tong_thuc_ton = $tong_thuc_ton + $t->so_luong_thuc_ton;
        }

        $rowNum = count($tmp) + 1 + $rowStartColumnTitles;
        $columnNum = count($this->columns);


        self::$activeSheet->setCellValue($startColumn . $rowNum, Yii::t('viLib', 'Total'));

        foreach ($this->columns as $n => $column) {
            $position++;
            if ($column->name !== null) {
                switch ($column->name) {
                    case 'ton_dau_ky':
                    {
                        self::$activeSheet->setCellValue($this->columnName($position) . $rowNum, $tong_ton_dau_ky);
                        $this->setCellFormatStyle($this->columnName($position), $rowNum, array('bold' => true), 'F2EF87 ', PHPExcel_Style_Alignment::HORIZONTAL_RIGHT, array('top' => true, 'right' => true, 'bottom' => true, 'left' => true), PHPExcel_Style_Border::BORDER_THIN);
                        $endTotalIndex[] = $position;
                        break;
                    }
                    case 'so_luong_nhap':
                    {
                        self::$activeSheet->setCellValue($this->columnName($position) . $rowNum, $tong_nhap_trong_ky);
                        $this->setCellFormatStyle($this->columnName($position), $rowNum, array('bold' => true), 'F2EF87 ', PHPExcel_Style_Alignment::HORIZONTAL_RIGHT, array('top' => true, 'right' => true, 'bottom' => true, 'left' => true), PHPExcel_Style_Border::BORDER_THIN);
                       // $cell = new PHPExcel_Cell($this->columnName($position),$rowNum);
                        //$this->advanceBinder->bindValue($cell,$tong_nhap_trong_ky);
                        $endTotalIndex[] = $position;
                        break;
                    }
                    case 'so_luong_xuat':
                    {
                        self::$activeSheet->setCellValue($this->columnName($position) . $rowNum, $tong_xuat_trong_ky);
                        $this->setCellFormatStyle($this->columnName($position), $rowNum, array('bold' => true), 'F2EF87 ', PHPExcel_Style_Alignment::HORIZONTAL_RIGHT, array('top' => true, 'right' => true, 'bottom' => true, 'left' => true), PHPExcel_Style_Border::BORDER_THIN);
                        $endTotalIndex[] = $position;
                        break;
                    }
                    case 'so_luong_ban':
                    {
                        self::$activeSheet->setCellValue($this->columnName($position) . $rowNum, $tong_ban_trong_ky);
                        $this->setCellFormatStyle($this->columnName($position), $rowNum, array('bold' => true), 'F2EF87 ', PHPExcel_Style_Alignment::HORIZONTAL_RIGHT, array('top' => true, 'right' => true, 'bottom' => true, 'left' => true), PHPExcel_Style_Border::BORDER_THIN);
                        $endTotalIndex[] = $position;
                        break;
                    }
                    case 'so_luong_tra':
                    {
                        self::$activeSheet->setCellValue($this->columnName($position) . $rowNum, $tong_tra_trong_ky);
                        $this->setCellFormatStyle($this->columnName($position), $rowNum, array('bold' => true), 'F2EF87 ', PHPExcel_Style_Alignment::HORIZONTAL_RIGHT, array('top' => true, 'right' => true, 'bottom' => true, 'left' => true), PHPExcel_Style_Border::BORDER_THIN);
                        $endTotalIndex[] = $position;
                        break;
                    }

                    case 'so_luong_thuc_ton':
                    {
                        self::$activeSheet->setCellValue($this->columnName($position) . $rowNum, $tong_thuc_ton);
                        $this->setCellFormatStyle($this->columnName($position), $rowNum, array('bold' => true), 'F2EF87 ', PHPExcel_Style_Alignment::HORIZONTAL_RIGHT, array('top' => true, 'right' => true, 'bottom' => true, 'left' => true), PHPExcel_Style_Border::BORDER_THIN);
                        $endTotalIndex[] = $position;
                        break;
                    }


                }
            }
        }
        $minTotalIndex = min($endTotalIndex);
        $endColumn = $this->columnName($minTotalIndex - 1);
        $this->setCellFormatStyle($startColumn, $rowNum, array('bold' => true), 'C1B5A5', PHPExcel_Style_Alignment::HORIZONTAL_CENTER, array('top' => true, 'right' => true, 'bottom' => true, 'left' => true), PHPExcel_Style_Border::BORDER_THIN);
        self::$activeSheet->mergeCells($startColumn . $rowNum . ":" . $endColumn . $rowNum);


    }

    public function formatThousand($startColumn = null, $rowStartColumnTitles = 0) {

        $tmp = $this->dataProvider->getData();
        $rowNum = count($tmp) + 1 + $rowStartColumnTitles;
        $columnNum = count($this->columns);
        self::$activeSheet->getStyle($startColumn . $rowStartColumnTitles . ":" . $this->columnName($columnNum) . $rowNum)->getNumberFormat()->setFormatCode("#,##0");
        //self::$activeSheet->getStyle($startColumn . $rowStartColumnTitles . ":" . $this->columnName($columnNum) . $rowNum)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

    }

    public function renderTimePeriod($startColumn, $startRow){
        $columnNum = count($this->columns);
        $timePeriodStr = Yii::t('viLib','From') . ' ' . $this->fromDate . ' ' . Yii::t('viLib','To') . ' '. $this->toDate;
        self::$activeSheet->setCellValue($startColumn . $startRow, $timePeriodStr);
        $this->setCellFormatStyle($startColumn, $startRow, array('bold' => true,'italic'=>true), '', PHPExcel_Style_Alignment::HORIZONTAL_CENTER, array('top' => true, 'right' => true, 'bottom' => true, 'left' => true), PHPExcel_Style_Border::BORDER_NONE);
        self::$activeSheet->mergeCells($startColumn . $startRow . ":" . $this->columnName($columnNum) . $startRow);

    }

    public function renderSaleBranchTotal($startColumn = null, $rowStartColumnTitles = 0)
    {
        //custom column and row
        if (isset($startColumn)) {
            $startIndex = $this->columnIndex($startColumn);
        } else {
            $startIndex = 0;
        }

        $tmp = $this->dataProvider->getData();
        $toTal = 0;
        foreach ($tmp as $t) {

            $toTal = $toTal + $t->tinhTongDoanhSo();
        }
        $rowNum = count($tmp) + 1 + $rowStartColumnTitles;

        $columnNum = count($this->columns);
        $endIndex = $startIndex + $columnNum-1;
        $endColumn = $this->columnName($endIndex);
        self::$activeSheet->setCellValue($startColumn . $rowNum, Yii::t('viLib', 'Total'));
        self::$activeSheet->setCellValue($this->columnName($endIndex + 1) . $rowNum, $toTal);
        $this->setCellFormatStyle($startColumn, $rowNum, array('bold' => true), 'C1B5A5', PHPExcel_Style_Alignment::HORIZONTAL_CENTER, array('top' => true, 'right' => true, 'bottom' => true, 'left' => true), PHPExcel_Style_Border::BORDER_THIN);
        $this->setCellFormatStyle($this->columnName($endIndex + 1), $rowNum, array('bold' => true), 'F2EF87 ', PHPExcel_Style_Alignment::HORIZONTAL_CENTER, array('top' => true, 'right' => true, 'bottom' => true, 'left' => true), PHPExcel_Style_Border::BORDER_THIN);
        self::$activeSheet->mergeCells($startColumn . $rowNum . ":" . $endColumn . $rowNum);


        // render text of amount
        $amountText = Helpers::readNumber($toTal);
        self::$activeSheet->setCellValue($startColumn . ($rowNum+2), Yii::t('viLib','Amount in text') . ' : ' . $amountText);
        $this->setCellFormatStyle($startColumn, $rowNum+2, array('italic' => true),'', PHPExcel_Style_Alignment::HORIZONTAL_LEFT, array('top' => true, 'right' => true, 'bottom' => true, 'left' => true), PHPExcel_Style_Border::BORDER_NONE);
        self::$activeSheet->mergeCells($startColumn . ($rowNum+2) . ":" . $endColumn . ($rowNum+2));

    }


    public function renderSaleTopTotal($startColumn = null, $rowStartColumnTitles = 0)
    {
        //custom column and row
        if (isset($startColumn)) {
            $startIndex = $this->columnIndex($startColumn);
        } else {
            $startIndex = 0;
        }

        $tmp = $this->dataProvider->getData();
        $toTal = 0;
        foreach ($tmp as $t) {

            $toTal = $toTal + array_sum($t->layDanhSachDoanhSo());
        }
        $rowNum = count($tmp) + 1 + $rowStartColumnTitles;

        $columnNum = count($this->columns);
        $endIndex = $startIndex + $columnNum-1;
        $endColumn = $this->columnName($endIndex);
        self::$activeSheet->setCellValue($startColumn . $rowNum, Yii::t('viLib', 'Total'));
        self::$activeSheet->setCellValue($this->columnName($endIndex + 1) . $rowNum, $toTal);
        $this->setCellFormatStyle($startColumn, $rowNum, array('bold' => true), 'C1B5A5', PHPExcel_Style_Alignment::HORIZONTAL_CENTER, array('top' => true, 'right' => true, 'bottom' => true, 'left' => true), PHPExcel_Style_Border::BORDER_THIN);
        $this->setCellFormatStyle($this->columnName($endIndex + 1), $rowNum, array('bold' => true), 'F2EF87 ', PHPExcel_Style_Alignment::HORIZONTAL_CENTER, array('top' => true, 'right' => true, 'bottom' => true, 'left' => true), PHPExcel_Style_Border::BORDER_THIN);
        self::$activeSheet->mergeCells($startColumn . $rowNum . ":" . $endColumn . $rowNum);


        // render text of amount
        $amountText = Helpers::readNumber($toTal);
        self::$activeSheet->setCellValue($startColumn . ($rowNum+2), Yii::t('viLib','Amount in text') . ' : ' . $amountText);
        $this->setCellFormatStyle($startColumn, $rowNum+2, array('italic' => true),'', PHPExcel_Style_Alignment::HORIZONTAL_LEFT, array('top' => true, 'right' => true, 'bottom' => true, 'left' => true), PHPExcel_Style_Border::BORDER_NONE);
        self::$activeSheet->mergeCells($startColumn . ($rowNum+2) . ":" . $endColumn . ($rowNum+2));

    }

    public function run()
    {
        $this->setDefaultStyle();
        $this->renderCompanyInfoHeader();
        $this->renderDocumentNo();
        $this->renderDocumentTitle();

        switch ($this->template) {
            case 'PhieuNhap':
            {
                $this->renderTitleColumns('A', 15);
                $this->renderPhieuNhapInfo();
                $this->renderBody('A', 16);
                $this->renderTotal('A', 15);
                $this->formatThousand('A',15);
                break;
            }
            case 'PhieuXuat':
            {
                $this->renderTitleColumns('A', 15);
                $this->renderPhieuXuatInfo();
                $this->renderBody('A', 16);
                $this->renderTotal('A', 15);
                $this->formatThousand('A',15);
                break;
            }
            case 'XuatNhapTon':
            {
                $this->renderTitleColumns('A', 10);
                $this->renderBody('A', 11);
                $this->renderImportExportTotal('A', 10);
                $this->formatThousand('A',10);
                $this->renderTimePeriod('A',8);
                // render total
                break;
            }
            case 'BanHangChiNhanh':
            {
                $this->renderTitleColumns('A', 10);
                $this->renderBody('A', 11);
                $this->renderSaleBranchTotal('A', 10);
                $this->formatThousand('A',10);
                $this->renderTimePeriod('A',8);
                break;
            }

            case 'BanHangTop':
            {
                $this->renderTitleColumns('A', 10);
                $this->renderBody('A', 11);
                $this->renderSaleTopTotal('A',10);
                $this->formatThousand('A',10);
                $this->renderTimePeriod('A',8);
                break;
            }
            case 'HoaDonBanHang':
            {
                $this->renderTitleColumns('A', 15);
                $this->renderHoaDonBanHangInfo();
                $this->renderBody('A', 16);
                $this->renderTotal('A', 15);
                $this->formatThousand('C',15);
                break;
            }

            default : {
                $this->renderCreatedDate();
                $this->renderTitleColumns();
                $this->renderBody();
                $this->formatThousand('C',10);
            }
        }
        $this->fixColumnsWidth();
        //set auto width
        if ($this->autoWidth)
            foreach ($this->columns as $n => $column)
                self::$activeSheet->getColumnDimension($this->columnName($n + 1))->setAutoSize(true);

        //create writer for saving
        $objWriter = PHPExcel_IOFactory::createWriter(self::$objPHPExcel, $this->exportType);
        if (!$this->stream)
            $objWriter->save($this->filename);
        else //output to browser
        {
            if (!$this->filename)
                $this->filename = $this->title;
            $this->cleanOutput();
            header('Set-Cookie: fileDownload=true; path=/'); //new for ajax download
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-type: ' . $this->mimeTypes[$this->exportType]['Content-type']);
            header('Content-Disposition: attachment; filename="' . $this->filename . '.' . $this->mimeTypes[$this->exportType]['extension'] . '"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
            ob_start();
            Yii::app()->end();
            ob_end_clean();

        }
    }

    private static function cleanOutput()
    {
        for ($level = ob_get_level(); $level > 0; --$level) {
            @ob_end_clean();
        }
    }

    public function columnIndex($columnName = 'A')
    {
        //check input valid from A-Z
        if (is_numeric($columnName) || $columnName < 0 || $columnName > 25)
            return 0;
        if (ord($columnName) >= 65 && ord($columnName) <= 90) {
            return ord($columnName) - 65;
        }
    }

}