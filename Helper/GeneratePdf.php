<?php

namespace Variux\Warranty\Helper;

use Magento\Framework\App\Helper\Context;

class GeneratePdf extends \Magento\Framework\App\Helper\AbstractHelper
{
    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    public function generateClaimHtml($claim)
    {
        $html = "
            <style>
                .xContent span {
                    color: black;
                    font-size: large;
                    font-weight: bold;
                }
                .xContent .nDung{
                    display: block;
                    margin: 10px 0;
                }
                .xContent .kohieu {
                    font-weight: normal;
                }
            </style>
            <h1>Warranty Information</h1>
            </br>
             <table class=\"data table table-warranty\"
                    cellspacing=\"1\"
                    cellpadding=\"1\"
                    border=\"1\"
                    align=\"center\" >
                    <thead>
                        <tr nobr=\"true\"
                            class=\"row\"
                            style=\"color: black;
                                    font-size: large;
                                    font-weight: bold; \">
                        </tr>
                    </thead>
                    <tbody >
                        <tr nobr=\"true\">
                            <td>" . $claim->getIncNum() . "</td>
                            <td>" . $claim->getDescription() . "</td>
                            <td>" . $claim->getEngine() . "</td>
                            <td>" . $claim->getCreatedAt() . "</td>
                            <td>" . $claim->getStatusString() . "</td>
                        </tr>
                    </tbody>
             </table>
             </br>
             <div class=\"xContent\">
                <div class=\"nDung\">
                    <span>
                        Item  : <span class=\"kohieu\">" . $claim->getItemSku() . "</span>
                    </span>
                </div>
                <div class=\"nDung\">
                    <span>
                        Boat Owner Name  : <span class=\"kohieu\">" . $claim->getBoatOwnerName() . "</span>
                    </span>
                </div>
                <div class=\"nDung\">
                    <span>
                        Dealer Claim/Reference #  : <span class=\"kohieu\">" . $claim->getReferenceNumber() . "</span>
                    </span>
                </div>
                <div class=\"nDung\">
                     <span>
                        Date of Failure  #  : <span class=\"kohieu\">" . $claim->getDateOfFailure() . "</span>
                     </span>
                </div>
                <div class=\"nDung\">
                    <span>
                        Date of Repair   : <span class=\"kohieu\">" . $claim->getDateOfRepair() . "</span>
                    </span>
                </div>
                <div class=\"nDung\">
                    <span>
                        Engine Hours   : <span class=\"kohieu\">" . $claim->getEngineHour() . "</span>
                    </span>
                </div>
                <div class=\"nDung\">
                    <span>
                        Invoice Number  : <span class=\"kohieu\">" . $claim->getInvoiceNumber() . "</span>
                    </span>
                </div>
                <div class=\"nDung\">
                    <span>
                        Order Number  : <span class=\"kohieu\">" . $claim->getOrderNumber() . "</span>
                    </span>
                </div>
                <div class=\"nDung\">
                    <span>
                        Dealer Contact Name : <span class=\"kohieu\">" . $claim->getDealerName() . "</span>
                    </span>
                </div>
                <div class=\"nDung\">
                    <span>
                        Dealership Phone Number : <span class=\"kohieu\">" . $claim->getDealerPhoneNumber() . "</span>
                    </span>
                </div>
                <div class=\"nDung\">
                    <span>
                        Claim Processors Email : <span class=\"kohieu\">" . $claim->getClaimProcessorEmail() . "</span>
                    </span>
                </div>
                <div class=\"nDung\">
                    <span>
                        Brief Description : <span class=\"kohieu\">" . $claim->getBriefDescription() . "</span>
                    </span>
                </div>
                <div class=\"nDung\">
                    <span>
                        Reason Note : <span class=\"kohieu\">" . $claim->getReasonNote() . "</span>
                    </span>
                </div>
                <div class=\"nDung\">
                    <span>
                        Resolution Note : <span class=\"kohieu\">" . $claim->getResolutionNote() . "</span>
                    </span>
                </div>
             </div>
        ";
        return $html;
    }

    public function generateSroDetailsHtml($materialHtml, $laborHtml, $miscHtml, $docHtml)
        {
            $html = "
                <h2 style=\"text-align: center;\">SRO Detail</h2>
                <h1>Material Items</h1>
                </br>
                <table class=\"data table table-warranty\" cellspacing=\"1\" cellpadding=\"1\" border=\"1\" align=\"center\">
                    <thead>
                        <tr nobr=\"true\"
                            class=\"row\"
                            style=\"color: black;font-size: large;font-weight: bold;padding: 10px;\">
                            <th>Item</th>
                            <th>Description</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        " . $materialHtml ."
                    </tbody>
                </table>
                </br>
                <h1>Labor Items</h1>
                </br>
                <table  class=\"data table table-warranty\"
                        cellspacing=\"1\"
                        cellpadding=\"1\"
                        border=\"1\"
                        align=\"center\">
                        <thead>
                            <tr nobr=\"true\"
                                class=\"row\"
                                style=\"color: black; font-size: large; font-weight: bold; padding: 10px;\">
                                <th>Work Code</th>
                                <th>Description</th>
                                <th>Hours</th>
                                <th>Labor Rate</th>
                                <th>Total</th>
                                <th>Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            " . $laborHtml . "
                        </tbody>
                </table>
                </br>
                <h1>Freight Items</h1>
                </br>
                <table class=\"data table table-warranty\"
                       cellspacing=\"1\"
                       cellpadding=\"1\"
                       border=\"1\"
                       align=\"center\">
                    <thead>
                        <tr nobr=\"true\"
                            class=\"row\"
                            style=\"color: black;
                            font-size: large;
                            font-weight: bold;
                            padding: 10px;\">
                            <th>Misc Code</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Note</th>
                        </tr>
                    </thead>
                    <tbody>
                       " . $miscHtml . "
                    </tbody>
                </table>
            ";
        }

}
