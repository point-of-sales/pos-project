<?php

Yii::import('zii.widgets.grid.CGridView');
/**
 * User: ${Cristazn}
 * Date: 4/8/13
 * Time: 4:25 PM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980
 */
class CEExcelView extends EExcelView
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
    public $documentTitle = null;
    public $template = null;


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

            if ($head == 'ID')
                $head = 'Số TT'; // replace ID with So TT

            self::$activeSheet->setCellValue($this->columnName($i) . $row, $head);
            $this->setCellFormatStyle($this->columnName($i), $row, array('bold' => true),'pro');
        }


    }

    // Main consuming function, apply every optimization you could think of
    public function renderBody()
    {
        if ($this->disablePaging) //if needed disable paging to export all data
            $this->enablePagination = false;

        self::$data = $this->dataProvider->getData();
        $n = count(self::$data);

        if ($n > 0)
            for ($row = 0; $row < $n; ++$row) {
                $this->renderRow($row);

            }
    }

    public function renderRow($row)
    {
        $i = 0;

        foreach ($this->columns as $n => $column):

            if ($column->value !== null) {

                $value = $this->evaluateExpression($column->value, array('row' => $row, 'data' => self::$data[$row]));
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
                            $cond1 = $this->dataProcess($condition[0], $row);
                            if ($condition[3] == 'true')
                                $cond2 = $condition[2];
                            else
                                $cond2 = $this->dataProcess($condition[2], $row);

                            $cond3 = $this->dataProcess($condition[4], $row);
                            $cond4 = $this->dataProcess($condition[5], $row);
                            break;
                        case 5:
                            $cond1 = $this->dataProcess($condition[0], $row);
                            $cond2 = $this->dataProcess($condition[2], $row);
                            $cond3 = $this->dataProcess($condition[3], $row);
                            $cond4 = $this->dataProcess($condition[4], $row);
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
                    $value = $this->dataProcess($column->name, $row);
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
            if($column->name=='id')
                self::$activeSheet->setCellValue($this->columnName(++$i) . ($row + 11), ($row+1));
            else
                self::$activeSheet->setCellValue($this->columnName(++$i) . ($row + 11), $value);
        endforeach;

        // As we are done with this row we DONT need this specific record
        unset(self::$data[$row]);
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

    public function setCellFormatStyle($columnStartName, $row, $textStyles = array(), $bgColor = null, $align = PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
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
            'alignment' => array(
                'horizontal' => $align,
            ),
            'fill' => array(
                'type' => ($bgColor != null) ? PHPExcel_Style_Fill::FILL_SOLID : PHPExcel_Style_Fill::FILL_NONE,
                'startcolor' => array('argb' => $bgColor)
            ),
        );

        // apply all style arrray
        self::$objPHPExcel->getActiveSheet()->getStyle($columnStartName . $row)->applyFromArray($styleArray);
    }

    public function fixColumnsWidth() {
        self::$activeSheet->getColumnDimension("A")->setWidth(6);
        self::$activeSheet->getColumnDimension("B")->setWidth(14);
        self::$activeSheet->getColumnDimension("C")->setWidth(13);
        self::$activeSheet->getColumnDimension("D")->setWidth(13);
        self::$activeSheet->getColumnDimension("E")->setWidth(13);
        self::$activeSheet->getColumnDimension("I")->setWidth(10);
        self::$activeSheet->getColumnDimension("J")->setWidth(14);
        self::$activeSheet->getColumnDimension("K")->setWidth(15);

    }


    public function renderDanhSachChiNhanh()
    {
        $this->setDefaultStyle();
        $this->renderCompanyInfoHeader();
        $this->renderCreatedDate();
        $this->renderDocumentNo();
        $this->renderDocumentTitle();
        $this->renderTitleColumns();
        $this->renderBody();
        $this->fixColumnsWidth();

    }

    public function run()
    {

        switch ($this->template) {
            case ExcelTemplate::DANH_SACH_CHI_NHANH:
            {
                $this->renderDanhSachChiNhanh();
                break;
            }
            case ExcelTemplate::DANH_SACH_SAN_PHAM:
            {
                break;
            }
            case 'sanphamtang':
            {

            }
            case 'hoadontra':
            {

            }
            case 'baogia':
            {

            }
            case 'nhacungcap':
            {

            }
            case 'khachhang':
            {

            }
            case 'baocao':
            {

            }

        }
        //$this->renderTitleColumns();
        //$this->renderBody();
        //$this->renderCompanyInfoFooter();
        //$this->renderFooter();

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
            ob_end_clean();
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-type: ' . $this->mimeTypes[$this->exportType]['Content-type']);
            header('Content-Disposition: attachment; filename="' . $this->filename . '.' . $this->mimeTypes[$this->exportType]['extension'] . '"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
            Yii::app()->end();
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