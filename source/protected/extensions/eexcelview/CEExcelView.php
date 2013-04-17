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
    public $documentTitle = '';
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
            $this->setCellFormatStyle($this->columnName($i), $row, array('bold' => true),'pro',PHPExcel_Style_Alignment::HORIZONTAL_CENTER,array('top'=>true, 'right'=>true, 'bottom'=>true, 'left'=>true),PHPExcel_Style_Border::BORDER_MEDIUM);
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

    public function renderRow($rowNo,$startColumn,$row)
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
            if($column->name=='id') {
                self::$activeSheet->setCellValue($this->columnName(++$i) . ($row+$rowNo), ($rowNo+1));
                //$this->setCellFormatStyle($this->columnName($i),$row+$rowNo,array(),null,PHPExcel_Style_Alignment::HORIZONTAL_CENTER,array('top'=>true,'right'=>true,'bottom'=>true,'left'=>true,PHPExcel_Style_Border::BORDER_DASHED));
                $this->setCellFormatStyle($this->columnName($i), $row+$rowNo, array(),null,PHPExcel_Style_Alignment::HORIZONTAL_CENTER,array('top'=>true, 'right'=>true, 'bottom'=>true, 'left'=>true),PHPExcel_Style_Border::BORDER_DASHED);
            }
            else {
                self::$activeSheet->setCellValue($this->columnName(++$i) . ($row+$rowNo), $value);

                $this->setCellFormatStyle($this->columnName($i), $row+$rowNo, array(),null,PHPExcel_Style_Alignment::HORIZONTAL_GENERAL,array('top'=>true, 'right'=>true, 'bottom'=>true, 'left'=>true),PHPExcel_Style_Border::BORDER_DASHED);
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

    public function setCellFormatStyle($columnStartName, $row, $textStyles = array(), $bgColor = null, $align = PHPExcel_Style_Alignment::HORIZONTAL_CENTER, $borderPosition=array('top'=>false,'right'=>false,'bottom'=>false,'left'=>false), $borderStyle=PHPExcel_Style_Border::BORDER_NONE)
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
            'borders'=>array(
                'top'=> ($borderPosition['top'])?array('style'=>$borderStyle):array('style'=>PHPExcel_Style_Border::BORDER_NONE),
                'right'=>($borderPosition['right'])?array('style'=>$borderStyle):array('style'=>PHPExcel_Style_Border::BORDER_NONE),
                'bottom'=>($borderPosition['bottom'])?array('style'=>$borderStyle):array('style'=>PHPExcel_Style_Border::BORDER_NONE),
                'left'=>($borderPosition['left'])?array('style'=>$borderStyle):array('style'=>PHPExcel_Style_Border::BORDER_NONE),
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


    public function renderNormalList()
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

        $this->setDefaultStyle();
        $this->renderCompanyInfoHeader();
        $this->renderCreatedDate();
        $this->renderDocumentNo();
        $this->renderDocumentTitle();
        $this->renderTitleColumns();
        $this->renderBody();
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