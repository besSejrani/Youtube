<?php

namespace App\Form;


class Form
{

    /**
     * @name startForm
     *
     * @param  string $action
     * @param  string $method
     * @return object
     * @description Returns the beginning of a form, specifying its action and method
     */
    public function startForm(string $action, string $method, ?string $enctype = null): object
    {
        $options = $enctype ? "enctype='$enctype' " : '';
        echo "<form action='$action' method='$method' $options>";
        return $this;
    }

    /**
     * @name endForm
     *
     * @return string
     * @description Close the form
     */
    public function endForm(): string
    {
        return  "</form>";
    }

    /**
     * @name myFile
     *
     * @param  string $name
     * @param  string $id
     * @return object
     * @description Returns a file picker
     */
    public function myFile(string $name, string $id): object
    {
        echo "<div class='form-group'>
        <label for='$id'>$name</label>
        <input type='file' class='form-control-file' id='$id' name='$name' required>
        </div>";

        return $this;
    }

    /**
     * @name myInput
     *
     * @param  string $type
     * @param  string $name
     * @param  string $id
     * @param  string $placeholder
     * @return object
     * @description Returns an input
     */
    public function myInput(string $type, string $name, string $id, ?string $placeholder = null): object
    {
        echo "<div class='form-group'>
                <label for='$id'>$name</label>
                <input type=$type class='form-control' name='$name' id='$id' placeholder='$placeholder' required>
              </div>";
        return $this;
    }

    /**
     * @name myTextArea
     *
     * @param  string $name
     * @param  string $id
     * @param  string $rows
     * @return object
     * @description Returns a text area
     */
    public function myTextArea(string $name, string $id, int $rows): object
    {
        echo "<div class='form-group'>
                <label for='$id'>$name</label>
                <textarea class='form-control' id='$id' name='$name' rows='$rows'></textarea>
              </div>";
        return $this;
    }

    /**
     * @name myDropDown
     *
     * @param  string $name
     * @param  string $id
     * @param  iterable $options
     * @return object
     * @description Returns a drop down
     */
    public function myDropDown(string $name, string $id, ...$options): object
    {
        echo "<div class='form-group'>
                <label for='$id'>$name</label>
                <select class='form-control' id='$id' name='$name'>";

        foreach ($options[0] as $option) {
            echo "<option value='$option[1]'>";
            echo ucfirst($option[1]);
            echo "</option>";
        }

        echo "</select>
                </div>";

        return $this;
    }

    /**
     * @name mySubmit
     *
     * @param string $name
     * @return object
     * @description Return a submit button
     */
    public function mySubmit(string $name): object
    {
        echo "<button type='submit' class='btn btn-primary' name='$name'>Submit</button>";
        return $this;
    }
}