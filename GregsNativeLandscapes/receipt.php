<?php

	print_r($_POST);
/*
    use PhpWord\IOFactory;
    use PhpWord\PhpWord;

    // Load the existing Word document
    $phpWord = IOFactory::load("receipt.docx");

    // Access sections and elements for editing
    $sections = $phpWord->getSections();
    if (!empty($sections)) {
        $section = $sections[0]; // Assuming you want to edit the first section

        // Example: Add a new text run
        $section->addText('This is new text added by PHP.');

        // Example: Replace text (requires iterating through elements)
        foreach ($section->getElements() as $element) 
        {
            if ($element instanceof \PhpOffice\PhpWord\Element\TextRun) 
            {
                foreach ($element->getElements() as $textElement) 
                {
                    if ($textElement instanceof \PhpWord\Element\Text) 
                    {
                        $text = $textElement->getText();
                        echo $text . "<br/>";
                    }
                }
            }
        }
    }
*/
    // Save the modified document
    /*
    $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
    $objWriter->save('path/to/your_modified_document.docx');
    */
?>