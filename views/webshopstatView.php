<div class="alignleft">
	<h2>Statistic for <?php echo $vars->wid?></h2>
    <div style="float: left;padding-right: 20px;">
        <h3>Search Query Size</h3>
        <?php if(sizeof($vars->numSearchesPerWord) >0 ):?>
        <table>
            <tr>
                <th>
                    Number of Keywords:
                </th>
                <th>
                    Number of searches:
                </th>
                <th>
                    Percentage of searches:
                </th>
            </tr>
        <?php
            foreach($vars->numSearchesPerWord as $data) {
                echo '<tr>';
                    echo '<td> '.$data->number_of_keywords.' </td>';
                    echo '<td>'.$data->count.'</td>';
                    echo '<td>'.$data->percent."</td>\n";
                echo '</tr>';
            }
        ?>
        </table>
        <?php else:?>
            No searches in log
        <?php endif?>
    </div>
    <div style="float: left;">
        <h3>Words</h3>
        <table>
            <tr>
                <td class="attribute-name">
                    Number of words:
                </td>
                <td class="attribute-value">
                    <?php echo $vars->numOfWords?>
                </td>
            </tr>
            <tr>
                <td class="attribute-name">
                    Number of ranked words:
                </td>
                <td class="attribute-value">
                    <?php echo $vars->numOfRankedWords?>
                </td>
            </tr>
            <tr>
                <td class="attribute-name">
                    Ranked words percentage:
                </td>
                <td class="attribute-value">
                    <?php echo $vars->percentageRanked . '%' ?>
                </td>
            </tr>
            <tr>
                <td class="attribute-name">
                    Ranked words threshold percentage:
                </td>
                <td class="attribute-value">
                    <?php echo $vars->percentageRankedThreshold . '%' ?>
                </td>
            </tr>
            <tr>
                <td class="attribute-name">
                    Important words (NOT dont care):
                </td>
                <td class="attribute-value">
                    <?php echo $vars->numOfWordsToCareAbout ?>
                </td>
            </tr>
        </table>
    </div>
</div>