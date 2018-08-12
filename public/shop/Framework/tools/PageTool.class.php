<?php
/**
 * Created by PhpStorm.
 * User: ShengSheng
 * Date: 2018/5/22
 * Time: 19:16
 */

class PageTool
{
    public static function show($url, $count, $totalPage, $page, $pageSize)
    {
        $prevPage = $page - 1 < 1 ? 1 : $page - 1;//上一页
        $nextPage = $page + 1 > $totalPage ? $totalPage : $page + 1;//下一页
        $html = <<<html
     <table id="page-table" cellspacing="0">
            <tbody>
            <tr>
                <td align="right" nowrap="true" style="background-color: rgb(255, 255, 255);">
                 
                    <div id="turn-page">总计 <span id="totalRecords">$count</span>个记录分为 <span id="totalPages">$totalPage</span>页当前第
                        <span id="pageCurrent">$page</span>
                        页，每页 <input type="text" size="3" id="pageSize" value="$pageSize"
                                    onkeypress="return listTable.changePageSize(event)">
                        <span id="page-link">
                            <a href="index.php?$url&page=1">第一页</a>
                            <a href="index.php?$url&page=$prevPage">上一页</a>
                            <a href="index.php?$url&page=$nextPage">下一页</a>
                            <a href="index.php?$url&page=$totalPage">最末页</a>
                        </span>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
html;
return $html;
    }

}