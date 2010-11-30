function GIDProducts(arrayProducts, hasSelectedProduct, strSelectedProductId) {
    this.hasSelectedProduct = hasSelectedProduct;
    this.strSelectedProductId = strSelectedProductId;
    this.arrayProducts = (!arrayProducts ? [] : arrayProducts); // array.
}

GIDProducts.prototype.addProduct = function (objProducts, objP, hasSelectedProduct, strSelectedProductId) {
    if (objProducts) {
        if (objP && (objP.strProductId.length > 1)) {
            if (objProducts.arrayProducts[objP.strProductId]) {
                if (!objProducts.arrayProducts[objP.strProductId].arrayVariantStyles[objP.strDefaultVariantId].isLoaded) {
                    objProducts.arrayProducts[objP.strProductId].arrayVariantStyles[objP.strDefaultVariantId] = objP.arrayVariantStyles[objP.strDefaultVariantId];
                    objProducts.arrayProducts[objP.strProductId].arrayVariantStyles[objP.strDefaultVariantId].isLoaded = true;
                }
            } else {
                objProducts.arrayProducts[objP.strProductId] = objP;
                objProducts.arrayProducts[objP.strProductId].arrayVariantStyles[objP.strDefaultVariantId].isLoaded = true;
                if (hasSelectedProduct && strSelectedProductId.length > 1) {
                    objProducts.setSelectedProduct(objProducts, hasSelectedProduct, strSelectedProductId);
                }
            }
        }
    }
}


GIDProducts.prototype.removeProduct = function (objProducts, objP, hasSelectedProduct, strSelectedProductId) {
    if (objProducts) {
        if ((objP) && (objP.strProductId.length > 1)) {
            if (objProducts.arrayProducts[objP.strProductId]) {
                delete objProducts.arrayProducts[objP.strProductId];
                if (hasSelectedProduct && strSelectedProductId.length > 1) {
                    objProducts.setSelectedProduct(objProducts, hasSelectedProduct, strSelectedProductId);
                }
            }
        }
    }
}

GIDProducts.prototype.setSelectedProduct = function (objProducts, hasSelectedProduct, strSelectedProductId) {
    if (objProducts) {
        objProducts.hasSelectedProduct = hasSelectedProduct;
        objProducts.strSelectedProductId = strSelectedProductId;
    }
}



function GIDProduct() {}

GIDProduct.prototype.toString = function (obj) {
    var strProps = "";
    for (var prop in obj) {
        if (!isPrototypeSafe(prop, obj)) continue;
        if (strProps == "") {
            if (typeof obj[prop] == "object") {
                var strProps = "<li>Object: <ol><b>" + prop + "</b><br>" + this.toStringParseConstructor(obj[prop].constructor) + "<ol> " + this.toString(obj[prop]) + "</ol></ol></li><br>";
            }	else {
                var strProps = "<li>" + prop + " = " + obj[prop] + "<br></li>";

            }
        }
        else {
            if (typeof obj[prop] == "object") {
                var isSubObjectProperty = true;
                var strProps = strProps + "<li>Object: <ol><b>" + prop + "</b><br>" + this.toStringParseConstructor(obj[prop].constructor) + "<ol> " + this.toString(obj[prop]) + "</ol></ol></li><br>";
            }	else {
                if (isSubObjectProperty) {

                }
                var strProps = strProps + "<li>" + prop + " = " + obj[prop] + "<br></li>";
            }

        }
    }
    var strProps = "<ol>" + strProps + "</ol>";
    return strProps;
}

GIDProduct.prototype.toStringParseConstructor = function (objConstructor) {
    var strConstructor = new String(objConstructor);
    var strX = strConstructor.indexOf(" {");
    var strConstructorName = strConstructor.substring(0, strX);
    var strX = 9;
    var strY = strConstructorName.indexOf("(");
    var strConstructorName = '<b>' + strConstructor.substring(strX, strY) + '</b>';
    return strConstructorName;
}

GIDProducts.prototype.toString = GIDProduct.prototype.toString;
GIDProducts.prototype.toStringParseConstructor = GIDProduct.prototype.toStringParseConstructor;

function GIDCategory (
    strCatalogItemId,
    strSetupCategoryId,
    arrayProducts) {

    this.strCatalogItemId = strCatalogItemId;
    this.strSetupCategoryId = strSetupCategoryId;
    this.arrayProducts = arrayProducts;
}

function GIDCategoryProduct(
    strCatalogItemId,
    strProductId,
    strSizeCategoryId,
    strVariantId) {

    this.strCatalogItemId = strCatalogItemId;
    this.strProductId = strProductId;
    this.strSizeCategoryId = strSizeCategoryId;
    this.strVariantId = strVariantId;
}

GIDCategory.prototype.toString = GIDProduct.prototype.toString;

function GIDOutfit(
    strOutfitName,
    strEditorialText,
    strSecondaryEditorialText,
    strOutfitId,
    strOutfitType,
    strOutfitSubType,
    isPhotoOutfit,
    arrayProducts,
    arrayItemType,
    arraySizeSelections,
    outfitPhotoImage) {

    this.strOutfitName = strOutfitName;
    this.strEditorialText = strEditorialText;
    this.strSecondaryEditorialText = strSecondaryEditorialText;
    this.strOutfitId = strOutfitId;
    this.strOutfitType = strOutfitType;
    this.strOutfitSubType = strOutfitSubType;
    this.isPhotoOutfit = eval(isPhotoOutfit);
    this.arrayProducts = (!arrayProducts ? new Array() : arrayProducts);
    this.arrayItemType = (!arrayItemType ? new Array() : arrayItemType);
    this.arraySizeSelections = (!arraySizeSelections ? new Array() : arraySizeSelections);
    this.outfitPhotoImage = outfitPhotoImage;
}

GIDOutfit.prototype.toString = GIDProduct.prototype.toString;

GIDProduct.prototype.InfoTab = function (
    strInfoTabId,
    strInfoTabName,
    intInfoTabSortOrder,
    hasInfoTabInfoBlocks,
    strInfoTabDescription,
    arrayInfoTabInfoBlocks) {

    this.strInfoTabId = strInfoTabId;
    this.strInfoTabName = strInfoTabName;
    this.intInfoTabSortOrder = intInfoTabSortOrder;
    this.hasInfoTabInfoBlocks = hasInfoTabInfoBlocks;
    this.strInfoTabDescription = strInfoTabDescription;
    this.arrayInfoTabInfoBlocks = arrayInfoTabInfoBlocks;
}

GIDProduct.prototype.InfoTabInfoBlock = function (
    strInfoBlockId,
    intSortOrder,
    strDisplayText,
    hasLink,
    isExternal,
    strExternalLink,
    isSizeChart,
    isPopUp,
    intPopUpHeight,
    intPopUpWidth,
    strTemplateAction,
    intBusinessId) {

    this.strInfoBlockId = strInfoBlockId;
    this.intSortOrder = intSortOrder;
    this.strDisplayText = strDisplayText;
    this.hasLink = hasLink;
    this.isExternal = isExternal;
    this.strExternalLink = strExternalLink;
    this.isSizeChart = isSizeChart;
    this.isPopUp = isPopUp;
    this.intPopUpHeight = intPopUpHeight;
    this.intPopUpWidth = intPopUpWidth;
    this.strTemplateAction = strTemplateAction;
    this.intBusinessId = intBusinessId;
}

GIDProduct.prototype.setArrayInfoTabInfoBlocks = function (objInfoTab, strInfoTabInfoBlocks) {
    with (objInfoTab) {
        var arrayTempInfoTabInfoBlocks = strInfoTabInfoBlocks.split("||");
        arrayInfoTabInfoBlocks = new Array();
        for (var intI = 0; intI < arrayTempInfoTabInfoBlocks.length; intI++) {
            var arrayInfoBlock = arrayTempInfoTabInfoBlocks[intI].split("^,^");
            var strInfoBlockId = arrayInfoBlock[0];
            var intSortOrder = eval(arrayInfoBlock[1]);
            var strDisplayText = arrayInfoBlock[2];
            var hasLink = eval(arrayInfoBlock[3]);
            var isExternal = eval(arrayInfoBlock[4]);
            var strExternalLink = arrayInfoBlock[5];
            var isSizeChart = eval(arrayInfoBlock[6]);
            var isPopUp = eval(arrayInfoBlock[7]);
            var intPopUpHeight = arrayInfoBlock[8];
            var intPopUpWidth = arrayInfoBlock[9];
            var strTemplateAction = arrayInfoBlock[10];
            var intBusinessId = arrayInfoBlock[11];
            arrayInfoTabInfoBlocks[intI] = new GIDProduct.prototype.InfoTabInfoBlock(
                strInfoBlockId,
                intSortOrder,
                strDisplayText,
                hasLink,
                isExternal,
                strExternalLink,
                isSizeChart,
                isPopUp,
                intPopUpHeight,
                intPopUpWidth,
                strTemplateAction,
                intBusinessId);
        }
    }
}

function ProductStyle(
    brandCode,
    strProductId,
    strVendorId,
    strCatalogItemId,
    strProductType,
    hasFitAttributeOverlayImages,
    hasAlternateImage,
    hasMarketingFlag,
    hasMarketingCallOut,
    strMupMessage,
    strGIDPromoMessage,
    sizeChartId,
    hasZoomEnabled,
    strProductPriceRange,
    isInStock,
    isOnSale,
    isOnClearence,
    isGiftCard,
    productClassTypId,
    hasCrossSell,
    hasSplitVariants,
    hasMergeVariants,
    isImported,
    intMaxOrderQuantity,
    intMaxQuantity,
    strProductStyleName,
    strStyleColorDisplayName,
    strAllowableReturnCode,
    strCareInstructionText,
    strFlammableWarningText,
    isHazardousMaterial,
    isNonGiftWrap,
    isWaterResistant,
    intBestSellingScore,
    intNewnessScore,
    strTaxExemptCode,
    strDefaultVariantId,
    strVendorName,
    objProductStyleImages,
    arrayInfoTabs,
    arrayVariantStyles,
    objCrossSellInfo,
    arrayFabricContent,
    objMarketingFlag,
    objMarketingCallOut) {

    this.brandCode = brandCode;
    this.strProductId = strProductId;
    this.strVendorId = strVendorId;
    this.strCatalogItemId = strCatalogItemId;
    this.strProductType = strProductType + "";
    this.hasFitAttributeOverlayImages = eval(hasFitAttributeOverlayImages);
    this.hasAlternateImage = eval(hasAlternateImage);
    this.hasMarketingFlag = eval(hasMarketingFlag);
    this.hasMarketingCallOut = eval(hasMarketingCallOut);
    this.strMupMessage = strMupMessage;
    this.strGIDPromoMessage = strGIDPromoMessage;
    this.sizeChartId = sizeChartId;
    this.hasZoomEnabled = eval(hasZoomEnabled);
    this.strProductPriceRange = strProductPriceRange;
    this.isInStock = eval(isInStock);
    this.isOnSale = eval(isOnSale);
    this.isOnClearence = eval(isOnClearence);
    this.isGiftCard = eval(isGiftCard);
    this.productClassTypId = productClassTypId;
    this.hasCrossSell = eval(hasCrossSell);
    this.hasSplitVariants = eval(hasSplitVariants);
    this.hasMergeVariants = eval(hasMergeVariants);
    this.isImported = eval(isImported);
    this.intMaxOrderQuantity = intMaxOrderQuantity;
    this.intMaxQuantity = intMaxQuantity;
    this.strProductStyleName = strProductStyleName;
    this.strStyleColorDisplayName = strStyleColorDisplayName;
    this.strAllowableReturnCode = strAllowableReturnCode;
    this.strCareInstructionText = strCareInstructionText;
    this.strFlammableWarningText = strFlammableWarningText;
    this.isHazardousMaterial = eval(isHazardousMaterial);
    this.isNonGiftWrap = eval(isNonGiftWrap);
    this.isWaterResistant = eval(isWaterResistant);
    this.intBestSellingScore = intBestSellingScore;
    this.intNewnessScore = intNewnessScore;
    this.strTaxExemptCode = strTaxExemptCode;
    this.strDefaultVariantId = strDefaultVariantId;
    this.strVendorName = strVendorName;
    this.objProductStyleImages = (!objProductStyleImages ? {} : objProductStyleImages);
    this.arrayInfoTabs = (!arrayInfoTabs ? [] : arrayInfoTabs);
    this.arrayVariantStyles = (!arrayVariantStyles ? {} : arrayVariantStyles);
    this.objCrossSellInfo = objCrossSellInfo;
    this.arrayFabricContent = (!arrayFabricContent ? [] : arrayFabricContent);
    this.objMarketingFlag = objMarketingFlag;
    this.objMarketingCallOut = objMarketingCallOut;
}

ProductStyle.prototype = new GIDProduct();

ProductStyle.prototype.setArrayProductStyleImages = function (arrayImages, strProductStyleImages) {
    var arrayTempStyleImages = strProductStyleImages.split("||");
    for (var intI = 0; intI < arrayTempStyleImages.length; intI++) {
        var arrayImage = arrayTempStyleImages[intI].split("^,^");
        var strImagePath = arrayImage[0];
        var strThumbImagePath = arrayImage[1];
        var strDisplayText = arrayImage[2];
        var intMediaType = arrayImage[3];
        var intWidth = arrayImage[4];
        var intHeight = arrayImage[5];
        arrayImages[intI] = new ProductStyle.prototype.styleImage(strImagePath, strThumbImagePath, strDisplayText, intMediaType, intWidth, intHeight);
    }
}

ProductStyle.prototype.setArrayVariantStyleColorImages = function (objProductStyleColor, strStyleColorImages) {
    with (objProductStyleColor) {
        var arrayTempVariantStyleColorImages = strStyleColorImages.split("||");
        for (var intI = 0; intI < arrayTempVariantStyleColorImages.length; intI++) {
            var arrayStyleColorImage = arrayTempVariantStyleColorImages[intI].split("^,^");
            var strImageType = arrayStyleColorImage[0];
            var strImagePath = arrayStyleColorImage[1];
            var strThumbImagePath = arrayStyleColorImage[2];
            arrayVariantStyleColorImages[strImageType] = new ProductStyle.prototype.StyleColorImage(strImageType, strImagePath, strThumbImagePath);
        }
    }
}

ProductStyle.prototype.StyleColor = function (
    strColorCodeId,
    strColorName,
    isOnSale,
    isOnClearance,
    isInStock,
    hasLargerImage,
    hasRotationalImages,
    intSortOrder,
    strRegularPrice,
    strSalePrice,
    strPromoPrice,
    strPartialMupMessage,
    strVendorStyleNumber,
    strVendorProductId,
    strProductStyleColorSkus,
    arrayVariantStyleColorImages,
    objMarketingFlag) {

    var styleColorVarUndefined;

    this.strColorCodeId = strColorCodeId;
    this.strColorName = strColorName;
    this.isOnSale = isOnSale;
    this.isOnClearance = isOnClearance;
    this.isInStock = isInStock;
    this.hasLargerImage = hasLargerImage;
    this.hasRotationalImages = hasRotationalImages;
    this.intSortOrder = intSortOrder;
    this.strRegularPrice = (strRegularPrice != null ? strRegularPrice : styleColorVarUndefined);
    this.strSalePrice = (strSalePrice != null ? strSalePrice : styleColorVarUndefined);
    this.strPromoPrice = (strPromoPrice != null ? strPromoPrice : styleColorVarUndefined);
    this.strPartialMupMessage = strPartialMupMessage;
    this.strVendorStyleNumber = strVendorStyleNumber;
    this.strVendorProductId = strVendorProductId;
    this.strProductStyleColorSkus = strProductStyleColorSkus;
    this.arrayVariantStyleColorImages = (!arrayVariantStyleColorImages ? new Array() : arrayVariantStyleColorImages); // array.
    this.objMarketingFlag = objMarketingFlag;
}

GIDProduct.prototype.SizeInfo = function (
    intSizeDimensionsCount,
    objSizeDimension1) {

    this.intSizeDimensionsCount = intSizeDimensionsCount;
    this.objSizeDimension1 = objSizeDimension1;
}

GIDProduct.prototype.SizeInfoSummary = function (
    intSizeDimensionsCount,
    intSizeCategoryId,
    strSizeDisplayName,
    strSizeDimension1Name,
    strSizeDimension2Name,
    strSizeDimension1Id,
    strSizeDimension2Id,
    strSizeDimension1ListOptions,
    strSizeDimension2ListOptions,
    hasSizeDimension1Default,
    hasSizeDimension2Default,
    strDefaultSizeDimension1SizeCodeId,
    strDefaultSizeDimension2SizeCodeId) {

    this.intSizeDimensionsCount = intSizeDimensionsCount;
    this.intSizeCategoryId = intSizeCategoryId;
    this.strSizeDisplayName = strSizeDisplayName;
    if (strSizeDimension1ListOptions != null) this.strSizeDimension1ListOptions = strSizeDimension1ListOptions;
    if (strSizeDimension2ListOptions != null) this.strSizeDimension2ListOptions = strSizeDimension2ListOptions;
    if (strSizeDimension1Name != null) this.strSizeDimension1Name = strSizeDimension1Name;
    if (strSizeDimension2Name != null) this.strSizeDimension2Name = strSizeDimension2Name;
    if (strSizeDimension1Id != null) this.strSizeDimension1Id = strSizeDimension1Id;
    if (strSizeDimension2Id != null) this.strSizeDimension2Id = strSizeDimension2Id;
    this.hasSizeDimension1Default = hasSizeDimension1Default;
    this.hasSizeDimension2Default = hasSizeDimension2Default;
    this.strDefaultSizeDimension1SizeCodeId = strDefaultSizeDimension1SizeCodeId;
    this.strDefaultSizeDimension2SizeCodeId = strDefaultSizeDimension2SizeCodeId;
}

ProductStyle.prototype.ProductStyleImages = function (arrayAlternateViewImages,arrayWaysToWearImages) {
    this.arrayAlternateViewImages = new Array();
    this.arrayWaysToWearImages = new Array();
}

GIDProduct.prototype.styleImage = function (strImagePath, strThumbImagePath, strImageDisplayText, intMediaType, intWidth, intHeight) {
    this.strImagePath = strImagePath;
    this.strThumbImagePath = strThumbImagePath;
    this.strImageDisplayText = strImageDisplayText;
    this.intMediaType = intMediaType;
    this.intWidth = intWidth;
    this.intHeight = intHeight;
}

GIDProduct.prototype.outfitPhotoImage = function (strImagePath, strImageDisplayText) {
    this.strImagePath = strImagePath;
    this.strImageDisplayText = strImageDisplayText;
}

GIDProduct.prototype.fabricType = function (intId, strName, strPercent) {
    this.intId = intId;
    this.strName = strName;
    this.strPercent = strPercent;
}

ProductStyle.prototype.StyleColorImage = function (
    strImageType,
    strImagePath,
    strThumbImagePath) {

    this.strImageType = strImageType;
    this.strImagePath = strImagePath;
    if (strThumbImagePath != undefined) this.strThumbImagePath = strThumbImagePath;
}

GIDProduct.prototype.VariantStyle = function (
    isLoaded,
    strCatalogItemId,
    strVariantId,
    strVariantName,
    arrayVariantStyleColors,
    arrayVariantSkus,
    objStyleSizeInfo) {

    this.isLoaded = eval(isLoaded);
    this.strCatalogItemId = strCatalogItemId;
    this.strVariantId = strVariantId;
    this.strVariantName = strVariantName;
    this.arrayVariantStyleColors = (!arrayVariantStyleColors ? new Array() : arrayVariantStyleColors); // array.
    this.arrayVariantSkus = (!arrayVariantSkus ? {} : arrayVariantSkus); // array.
    this.objStyleSizeInfo = objStyleSizeInfo;
}

GIDProduct.prototype.VariantSku = function (
    strSkuId,
    strSizeDim1Id,
    strSizeDim2Id,
    isLowInventory,
    isOnOrder,
    strOnOrderDate,
    strUPCCode,
    strAllowableReturnCode,
    strCurrentPrice,
    strRegularPrice,
    objMarketingFlag) {

    this.strSkuId = strSkuId;
    this.strSizeDim1Id = strSizeDim1Id;
    this.strSizeDim2Id = strSizeDim2Id;
    this.isLowInventory = eval(isLowInventory);
    this.isOnOrder = eval(isOnOrder);
    this.strOnOrderDate = strOnOrderDate;
    this.strUPCCode = strUPCCode;
    this.strAllowableReturnCode = strAllowableReturnCode;
    this.strCurrentPrice = strCurrentPrice;
    this.strRegularPrice = strRegularPrice;
    this.objMarketingFlag = objMarketingFlag;
}

GIDProduct.prototype.setProductVariantStyles = function(arrayVariantStyles,strVariantStyles) {
    strVariantStyles.split('||').
        invoke('split','^,^').inject(arrayVariantStyles,
            function(obj, value) {
                obj[Number(value[0])] = new GIDProduct.prototype.VariantStyle(false,
                    value[1],value[2],value[3]);
                return obj;

            }
        );
}

GIDProduct.prototype.setProductVariantSkus = function (objVariantStyle) {
    with(objVariantStyle) {
        for (var intI in arrayVariantStyleColors) {
            if (!isPrototypeSafe(intI, arrayVariantStyleColors)) continue;
            var arrayTempSkus = arrayVariantStyleColors[intI].strProductStyleColorSkus.split("||");
            for (var intJ in arrayTempSkus) {
                if (!isPrototypeSafe(intJ, arrayTempSkus)) continue;
                var arrayTempSku = arrayTempSkus[intJ].split("^,^");
                var strSkuId = arrayTempSku[0];
                var strSizeDim1Id = arrayTempSku[1];
                var strSizeDim2Id = arrayTempSku[2];
                var isLowInventory = arrayTempSku[3];
                var isOnOrder = arrayTempSku[4];
                var strOnOrderDate = arrayTempSku[5];
                var strUPCCode = arrayTempSku[6];
                var isMailReturn = arrayTempSku[7];
                var strCurrentPrice = arrayTempSku[8];
                var strRegularPrice = arrayTempSku[9];
                if (arrayTempSku.length > 10) {
                    var objMarketingFlag = new GIDProduct.prototype.marketingFlag(arrayTempSku[10],arrayTempSku[11],arrayTempSku[12],arrayTempSku[13])
                    var strMarketingFlagAttribs = arrayTempSku[14];
                    if (strMarketingFlagAttribs) {
                            var arrayAttrib = strMarketingFlagAttribs.split("|,|");
                            var objAttribs = new GIDProduct.prototype.marketingFlagAttributes(
                                arrayAttrib[0],
                                arrayAttrib[1],
                                arrayAttrib[2],
                                arrayAttrib[3],
                                arrayAttrib[4],
                                arrayAttrib[5],
                                arrayAttrib[6]);

                    }
                } else {
                    var objMarketingFlag = undefined;
                }
                if (strSizeDim2Id) {
                    var strIndex1 = arrayVariantStyleColors[intI].strColorCodeId + "_" + strSizeDim1Id + "_";
                    var strIndex2 = arrayVariantStyleColors[intI].strColorCodeId + "__" + strSizeDim2Id;
                    arrayVariantSkus[strIndex1] = (arrayVariantSkus[strIndex1] ? arrayVariantSkus[strIndex1] + strSizeDim2Id : strSizeDim2Id) + ",";
                    arrayVariantSkus[strIndex2] = (arrayVariantSkus[strIndex2] ? arrayVariantSkus[strIndex2] + strSizeDim1Id : strSizeDim1Id) + ",";
                }
                var strMap = arrayVariantStyleColors[intI].strColorCodeId + "_" + strSizeDim1Id + "_" + strSizeDim2Id;
                arrayVariantSkus[strMap] = new GIDProduct.prototype.VariantSku(
                    strSkuId,
                    strSizeDim1Id,
                    strSizeDim2Id,
                    isLowInventory,
                    isOnOrder,
                    strOnOrderDate,
                    strUPCCode,
                    isMailReturn,
                    strCurrentPrice,
                    strRegularPrice,
                    objMarketingFlag);
            }
        }
    }
}

GIDProduct.prototype.setFabricContent = function(arrayFabricContent, strFabricContent) {
        var arrayFabrics = strFabricContent.split("||");
        for (var i in arrayFabrics) {
            if (!isPrototypeSafe(i, arrayFabrics)) continue;
            var arrayVals = arrayFabrics[i].split("^,^");
            var fabricObj = new GIDProduct.prototype.fabricType(arrayVals[0],arrayVals[1],arrayVals[2]);
            arrayFabricContent.push(fabricObj);
        }
}

GIDProduct.prototype.marketingFlag = function(
    isImageType,
    intMarketingFlagId,
    strMarketingFlagName,
    intMarketingFlagTypeId,
    objMarketingFlagAttributes) {

    this.isImageType = eval(isImageType);
    this.intMarketingFlagId = intMarketingFlagId;
    this.strMarketingFlagName = strMarketingFlagName;
    this.intMarketingFlagTypeId = intMarketingFlagTypeId;
    this.objMarketingFlagAttributes = objMarketingFlagAttributes;
}

GIDProduct.prototype.marketingFlagAttributes = function(
    strAltTagText,
    intCatalogContentId,
    intContentTypeId,
    intMediaTypeId,
    strPath,
    intHeight,
    intWidth) {

    this.strAltTagText = strAltTagText;
    this.intCatalogContentId = intCatalogContentId;
    this.intContentTypeId = intContentTypeId;
    this.intMediaTypeId = intMediaTypeId;
    this.strPath = strPath;
    this.intHeight = intHeight;
    this.intWidth = intWidth;
}

GIDProduct.prototype.crossSellInfo = function(
    intTypeId,
    isPhotoOutfit,
    isNonPhotoOutfit,
    hasAssociatedItems,
    isProductSet,
    strCopy,
    strLabelHeader,
    strLabelName,
    strImageSrc,
    strLink,
    arrayProducts) {

    this.intTypeId = intTypeId;
    this.isPhotoOutfit = isPhotoOutfit;
    this.isNonPhotoOutfit = isNonPhotoOutfit;
    this.hasAssociatedItems = hasAssociatedItems;
    this.isProductSet = isProductSet;
    this.strCopy = strCopy;
    this.strLabelHeader = strLabelHeader;
    this.strLabelName = strLabelName;
    this.strImageSrc = strImageSrc;
    this.strLink = strLink;
    this.arrayProducts = (!arrayProducts ? new Array() : arrayProducts);
}

GIDProduct.prototype.crossSellItem = function(
    intCatalogItemId,
    strName,
    strVendorName,
    strImgSrc,
    strPrice,
    strProductLink,
    isOutfitItem,
    mups,
    brandCode){

    this.intCatalogItemId = intCatalogItemId;
    this.strName = strName;
    this.strVendorName = strVendorName;
    this.strImgSrc = strImgSrc;
    this.strPrice = strPrice;
    this.strProductLink = strProductLink;
    this.isOutfitItem = isOutfitItem;
    this.mups = mups;
    this.brandCode = brandCode;
}

var objGIDPageViewAdapter = {
    initialized: false,
    initializeGidProducts : function () {
        if(objGIDPageViewAdapter.initialized) return;

        objGIDPageViewAdapter.objGIDProducts = new GIDProducts();
        objGIDPageViewAdapter.initialized = true;
    }
};


objGIDPageViewAdapter.initializeGidProducts();


/**
 * Extends brandConst with the CopyBox and resources obj
 * @requires brandConst Defined in brandConst.js
 * @author yoshi chen
 */

Object.extend(brandConst, {
	CopyBox : {
		GROUP_NAME : {Overview : resourceBundleValues.product.groupNameOverview, Tips : resourceBundleValues.product.groupNameTips, Fabric : resourceBundleValues.product.groupNameFabric, Fit : resourceBundleValues.product.groupNameFit},
		GROUP_NAME_DEFAULT : resourceBundleValues.product.groupNameDefault
	},
	/**
 	* resources - Define asset path for Quicklook and Buttons
 	* This is a method of class brandConst
 	* Modified:  Keo 12/04/07 - Added Comments
 	* @author Unkown
 	*/
	resources : { ASSET_PATH : '/assets/common/quicklook/'+brandConst.BRAND_LOCALE+'/', BTN_PATH :  '/assets/common/buttons/'+brandConst.BRAND_LOCALE+'/',
		ADD_TO_BAG_CLASS : 'button_add_to_bag'},

    variantMap :{
        '1': {QuickLook:['quickLook'], Main : ['main'], Category:['thumb'], Large : ['large'], Swatch : ['swatch']},
        '3': {QuickLook:['quickLook'], Main : ['main'], Category:['thumb'], Large : ['large'], Swatch : ['swatch']},
        '2': {QuickLook:['quickLook'], Main : ['main'], Category:['thumb'], Large : ['large'], Swatch : ['swatch']},
        '4': {QuickLook: ['quickLook'], Main : ['main'], Category:['thumb'], Large : ['large'], Swatch : ['swatch'],
            Right : ['main', 'thumb', 'large', 'quickLook'],
            Left : ['main', 'thumb', 'large', 'quickLook'],
            Top : ['main', 'thumb', 'large', 'quickLook'],
            Bottom : ['main', 'thumb', 'large', 'quickLook'],
            Front : ['main', 'thumb', 'large', 'quickLook'],
            Back :['main', 'thumb', 'large', 'quickLook']},
        '7': {QuickLook:['quickLook'], Main : ['main'], Category:['thumb'], Large : ['large'], Swatch : ['swatch']},
        '8': {QuickLook:['quickLook'], Main : ['main'], Category:['thumb'], Large : ['large'], Swatch : ['swatch']},
        '9': {QuickLook:['quickLook'], Main : ['main'], Category:['thumb'], Large : ['large'], Swatch : ['swatch']},
        '10': {QuickLook:['quickLook'], Main : ['main'], Category:['thumb'], Large : ['large'], Swatch : ['swatch']},
        '20': {QuickLook:['quickLook'], Main : ['main'], Category:['thumb'], Large : ['large'], Swatch : ['swatch']},
        '21': {QuickLook:['quickLook'], Main : ['main'], Category:['thumb'], Large : ['large'], Swatch : ['swatch']}
        
    },
    INTCOLORSWATCHWIDTH : {'1':18,'2':18,'3':18,'4':35,'10':18,'7':18,'8':18,'9':18,'20':18,'21':18},
    OUTFIT_SMODULE_WIDTH: {'1':58,'2':58,'3':58,'4':58,'10':77,'7':58,'8':58,'9':58,'20':58,'21':58},
    OUTFIT_SMODULE_HEIGHT: {'1':77,'2':77,'3':77,'4':58,'10':77,'7':77,'8':77,'9':77,'20':77,'21':77},
    perspViewLength : {'1':1,'3':1,'2':1,'4':7, '7':1, '8':1, '9':1, '10':1,'7':1,'8':1,'9':1,'20':1,'21':1},
    productClassTypeId : {'APPAREL':1,'SHOES':2,'HANDBAG':3}
});

/**
 * GID - Root Level of js object
 * @constructor
 * @author Unknown
 * @date 12/04/2007
 */
var GID = {};
GID.Browse = {
	Errors : {isProductDataError:false, isAddToBagError:false},
	Pops : {}
};
/**
 * Base Class for QuickLook, ProductPage, as well as Outfit and ShoppingBagEdit
 * @constructor
 * @author yoshi chen
 */
// prototype for GidBase
GID.Browse.Base = {

	strAddToBagClass: brandConst.resources.ADD_TO_BAG_CLASS,

	objCookieData: {color: -1, s1: -1, s2: -1, qty: -1},
	strDefaultStyleColorId: -1,

	intTab: 0,
	activeColor: -1,
	activeSizeDimension1: -1,
	activeSizeDimension2: -1,
	selectedColor: -1,
	selectedSizeDimension1: -1,
	selectedSizeDimension2: -1,
	strSelectedQty: 1,
	intTabOverviewIndex: -1,
	intDataLoadCounter: 0,
	dataLoaderAction: '',
	selectedColorName: '',
	selectedSizeDimension1Name: '',
	selectedSizeDimension2Name: '',
	strDisplayType: '',
	strSBSUrlSuffix: '&actFltr=true',

	arrayAllSizeDimension1: [],
	arrayAllSizeDimension2: [],
	arrayAddtoBagErrors: [],

//	isLoaded: false,
	isColorError: false,
	isSizeDimension1Error: false,
	isSizeDimension2Error: false,
	isBagError: false,
	hasStyleColorMarketingFlag: false,
	hasSkuMarketingFlag: false,
	isColorTextWrap: false,
	hasInlineBagErrors: false,
	isFromSBS: (getQuerystringParam('actfltr') == 'true'),
	enableDrag: true,
    hiddenDropDowns: [],

	THUMB_WIDTH : brandConst.PRODUCT_THUMB_WIDTH,
	THUMB_HEIGHT : brandConst.PRODUCT_THUMB_HEIGHT,

	// common base templates for all components
	templates : {
		BAG_ERROR : new Template('<div id="bagErrorLeft"></div>' +
							'<div id="bagErrorMiddle">#{msg}</div>' +
							'<div id="bagErrorRight"></div>'),
		COLOR_SWATCH : new Template(
					'<label for="colorSwatch_#{index}#{id}" class="cssHide2" >#{label} #{altText}</label><input type="image" id="colorSwatch_#{index}#{id}" onclick="#{app}.setColor(#{index})" onfocus="#{app}.swatchOver(\'color\', #{index});" onMouseOver="#{app}.swatchOver(\'color\',#{index});" onblur="#{app}.swatchOut(\'color\',#{index});" onmouseout="#{app}.swatchOut(\'color\',#{index});" src="#{path}" width="#{swatchSize}" height="#{swatchSize}" alt="#{altText}"/>'
		),

		DIM_SWATCH : new Template(
			'<label for="size#{type}Swatch_#{index}#{id}" class="cssHide2" >#{label} #{size}</label><button type="button" id="size#{type}Swatch_#{index}#{id}" onfocus="#{app}.swatchOver(\'size#{type}\',#{index});" onmouseover="#{app}.swatchOver(\'size#{type}\',#{index});" onblur="#{app}.swatchOut(\'size#{type}\',#{index});" onmouseout="#{app}.swatchOut(\'size#{type}\',#{index});" onClick="#{app}.setSizeDimension#{type}(#{index});">#{size}</button>'
		),

		BR_CLEAR : '<br style="clear:both;"/>',
		DIV_CLEAR : '<div style="clear:both;"></div>',
		MUP_SEPERATOR : '<div style="clear:both;"></div><hr class="mupSeperator" />',

		BULLET : new Template('<li>#{content}</li>'),
		PERCENT : new Template('#{percent}% #{name}#{divider}'),

		INFO_BLOCK_NEW : new Template('<div class="copyBlock">#{name}</div><ul>#{content}</ul>'),
		INFO_BLOCK_OLD  : new Template('<ul>#{content}</ul>'),

		VARIANT_BTNS : new Template(
				'<li><img onclick="#{onclick}" class="productpage-sprites sprite-varianttab_#{name}_#{state}" src="/assets/common/clear.gif" alt="#{name}" border="0" style="#{style}"/></li>' ),

		MORE_VIEWS : new Template('<img id="moreViewsBtn" class="quicklook-sprites sprite-button_more_views" src="/assets/common/clear.gif" border="0" onclick="#{app}.openProductImages();" style="margin-bottom:1px;">'),

		VARIANT : new Template(
						'<a href="javascript:#{app}.loadVariantProduct(#{catalogItemId},#{variantId});">#{name}</a>&nbsp;'),

		OVERVIEW_TEMP : new Template(
						'#{content}<p class="productId">\##{id}</p><p class="productDetail"><a href="javascript:#{app}.goProductPage();">#{link}</a></p>'),

		MARKETING_FLAG : new Template('<span class="productMarketingFlag">#{name}</span>'),
		TEXT_COLOR : new Template('<div class="swatchLabelName"><span class="swatchLabel">#{label}</span> <span style="font-weight: normal">#{colorLabel}:</span> #{name}</div>'),
		SIZE_LABEL_TEXT : new Template('<span class="swatchLabel">#{label}</span> #{dispName}: <span class="swatchLabelName">#{name}</span>'),

		INLINE_BAG_URL : new Template('/buy/inlineShoppingBagAdd.do?skuid=#{sku}&quantity#{sku}=#{qty}&sfl#{sku}=false&cid#{sku}=#{cid}'),

		PRODUCT_DATA_URL : new Template(
				brandConst.CATALOG_2_ACTIVE == 'true' ? '/browse/' + brandConst.PRODUCTDATA_2_ACTION + '?pid=#{pid}&vid=#{vid}&scid=#{scid}#{type}&actFltr=#{actFltr}&locale=#{localeCode}' :
                        '/browse/productData.do?pid=#{pid}&vid=#{vid}&scid=#{scid}#{type}&actFltr=#{actFltr}&locale=#{localeCode}'),

		LINE_ITEM : new Template(
			'	<li id="lineItem#{count}" class="clearfix lineItem">' +
			'		<div class="badgeContent"><img class="badge" src="#{badgeSrc}" alt="#{badgeAlt}"></img></div>' +
			'		<div class="lineItemDetails">' +
			'			<div class="imageContent">#{imageContent}</div>' +
			'			<div class="infoContent">' +
			'				<ul>' +
			'					<li class="styleDescription"><a href="#{productNameHref}" class="productName"><span class="styleDescriptionSpan">#{styleDescription}</span></a></li>' +
			'					<li class="sku">##{sku}</li>' +
			'				</ul>' +
			'			</div>' +
			'			<div class="infoContent2">' +
			'				<ul>' +
			'					<li class="colorDescription">' +
			'						<div class="label">#{labelColor}</div>' +
			'						<div class="colorDescriptionSpan productDetail">#{color}</div>' +
			'					</li>' +
			'					<li class="skuDescription">' +
			'						<div class="label">#{labelSize}</div>' +
			'						<div class="skuDescriptionSpan productDetail"/>#{size}</div>' +
			'					</li>' +
			'					<li>' +
			'					   <div class="label">#{labelPrice}</div>' +
			'						<div class="hasSellPrice">' +
			'							<div><span class="reg-price-strike">#{listPrice}</span></div>' +
			'							<div class="salePrice">#{discountedPrice}</div>' +
			'							<div class="sellPrice">#{sellPrice}</div>' +
			'						</div>' +
			'					</li>' +
			'					<li class="quantityAndItemSubtotal">' +
			'						<div class="label">#{labelQuantity}</div>' +
			'						<div class="quantity">#{quantity}</div>' +
			'						<div class="itemSubtotal">' +
			'							<span class="itemSubtotalSpan productDetail">#{subTotal}</span>' +
			'						</div>' +
			'					</li>' +
			'				</ul>' +
			'			</div>' +
			'		</div>' +
			'	</li>'
		),
		
		TEXTREADERMESSAGE : new Template(resourceBundleValues.strinlineBagScreenTextReaderMessage)

	},

	resources : gidLib.clone(brandConst.resources),

	commonDomObjMap : {
		objSoldOutMsg : "productSoldOutMsg",
	   objColorErrorMsg : "productColorError",
	   objSizeDimension1ErrorMsg : "productSizeDimension1Error",
	   objSizeDimension2ErrorMsg : "productSizeDimension2Error",
	   objBagErrorMsg : "productBagError"
	},

/**
 * set swatch color on mouse click
 * @param {integer} i index for the color in color array
 * @author yoshi
 */
	setColor : function(i) {
		var swatch = this.objV.ProductImages.swatch[i];
		if (i != this.selectedColor && swatch) {
			this.productThumbs.setColor(i, swatch);
			this.setColorSwatches();
			this.setSizeDimensionSwatches(1, this.size1Swatches);
			this.setSizeDimensionSwatches(2, this.size2Swatches);
			this.updateDataLabels();
			if (this.isColorError) {
				this.isColorError = false;
				this.objColorErrorMsg.style.visibility = 'hidden';
				this.setBagError();
			}
			this.clearAddToBagError();
		}
	},

/**
 * set dimension 1 for product, such as waist size
 * @param {integer} i index in sku array
 * @author yoshi
 */
	setSizeDimension1 : function(i) {
		if (i != this.selectedSizeDimension1) {
			this.selectedSizeDimension1 = i;
			this.activeSizeDimension1 = i;
			this.selectedSizeDimension1Name = (this.arrayAllSizeDimension1[i] ? this.arrayAllSizeDimension1[i].strName : "");

			this.setColorSwatches();
			this.setSizeDimensionSwatches(1, this.size1Swatches);
			this.setSizeDimensionSwatches(2, this.size2Swatches);
			this.updateDataLabels();
			if (this.isSizeDimension1Error) {
				this.isSizeDimension1Error = false;
				setObjVisibility(this.objSizeDimension1ErrorMsg,"hidden");
				this.setBagError();
			}
			this.clearAddToBagError();
		}
	},

/**
 * set dimension 2 for product, such as length
 * @param {integer} i index in sku array
 * @author yoshi
 */
	setSizeDimension2 : function(i) {
		if (i != this.objP.selectedSizeDimension2) {
			this.selectedSizeDimension2 = i;
			this.activeSizeDimension2 = i;
			this.selectedSizeDimension2Name = (this.arrayAllSizeDimension2[i] ? this.arrayAllSizeDimension2[i].strName : "");

			this.setColorSwatches();
			this.setSizeDimensionSwatches(1, this.size1Swatches);
			this.setSizeDimensionSwatches(2, this.size2Swatches);
			this.updateDataLabels();
			if (this.isSizeDimension2Error) {
				this.isSizeDimension2Error = false;
				setObjVisibility(this.objSizeDimension2ErrorMsg,"hidden");
				this.setBagError();
			}
			this.clearAddToBagError();
		}
	},

/**
 * sets the width of dimension btn to be the same, btn can contain text such as S, M, L, XL, XXL, this function
 * sets all width to be the max width of all btns
 * @param {integer} dim dimension
 * @param {object} ele the btn
 * @param {integer} minWidth the minimum width
 * @author yoshi
 */

	setCommonDimensionSizeWidth : function(dim, ele, minWidth) {
		var sizeInfo = this.objV.objStyleSizeInfo;
		if(sizeInfo.intSizeDimensionsCount < 2 && dim == 2 ) { return; }
		var sizeDim = this['size' + dim + 'Buttons'], maxDimWidth = sizeDim.invoke('getDimensions').pluck('width').max() + 2;
		if( sizeInfo.intSizeDimensionsCount == 1 ) { ele.style.width = '100%'; }
		sizeDim.invoke('setStyle', {width: Math.max(maxDimWidth, minWidth||maxDimWidth)+1  + 'px'});
	},

/**
 * updates color, and size info when mouse over, checks for availibility as well
 * @param {string} type type of btn, 'color', 'size1', 'size2'
 * @param {integer} index btn index
 * @author yoshi
 */
	swatchOver : function(type,index) {
		switch(type) {
			case "color":
				if (index != this.selectedColor) {
					this.productThumbs.swatchOver(index);
					this.setSizeDimensionSwatches(1, this.size1Swatches);
					this.setSizeDimensionSwatches(2, this.size2Swatches);
				}
				break;
			case "size1":
				if (index != this.selectedSizeDimension1) {
					this.activeSizeDimension1 = index;
					this.setColorSwatches();
					this.setSizeDimensionSwatches(2, this.size2Swatches);
				}
				break;
			case "size2":
				if (index != this.selectedSizeDimension2) {
					this.activeSizeDimension2 = index;
					this.setColorSwatches();
					this.setSizeDimensionSwatches(1, this.size1Swatches);
				}
				break;
		}

		var objImg = this[type + 'Buttons'][index];
		if (objImg.className != "soldOut" && objImg.className != "selectedSoldOut") {
			objImg.className = "hover";
		}

		this.updateDataLabels();
	},

/**
 * undo everything on mouse out
 * @param {string} type btn type
 * @param {integer} index btn index
 * @see swatchOver
 * @author yoshi
 */
	swatchOut : function(type,index) {
		var doMouseOut = false;
		switch(type) {
			case "color":
				if (index == this.activeColor) {
					this.productThumbs.swatchOut(index);
					doMouseOut = true;
				}
				break;
			case "size1":
				if (index == this.activeSizeDimension1) {
					doMouseOut = true;
				}
				break;
			case "size2":
				if (index == this.activeSizeDimension2) {
					doMouseOut = true;
				}
				break;
		}
		if (doMouseOut) {
			this.activeColor = this.selectedColor;
			this.activeSizeDimension1 = this.selectedSizeDimension1;
			this.activeSizeDimension2 = this.selectedSizeDimension2;
			this.setColorSwatches();
			this.setSizeDimensionSwatches(1, this.size1Swatches);
			this.setSizeDimensionSwatches(2, this.size2Swatches);
		}
		this.updateDataLabels();
	},

/**
 * updates the color name of the product
 * @author yoshi
 */
	setTextColor : function() {
		this.objTextColor.innerHTML =
				this.getTextColor(this.objV.arrayVariantStyleColors[this.activeColor].strColorName);
	},

/**
 * updates product dimension1 text
 * @author yoshi
 */
	setTextSizeDimension1 : function() {
		var strVariant = this.objV.strVariantName, str = '';
		if (this.objV.objStyleSizeInfo.intSizeDimensionsCount >= 1) {
			if (this.activeSizeDimension1 != -1) {
				str = this.arrayAllSizeDimension1[this.activeSizeDimension1].strName;
			}
			if (this.strRegularVariant != strVariant.toLowerCase()) str += " " + strVariant;
			this.objTextSizeDimension1.innerHTML = this.getSizeDimension1Text(str);
		}
	},

/**
 * updates product dimension2 div text
 * @author yoshi
 */
	setTextSizeDimension2 : function() {
		var strVariant = this.objV.strVariantName, str = "", objSid;
		if (this.objV.objStyleSizeInfo.intSizeDimensionsCount == 2) {
			if (this.activeSizeDimension2 != -1) {
				objSid = this.objV.arrayVariantStyleColors[this.activeColor];
				str = this.arrayAllSizeDimension2[this.activeSizeDimension2].strName;
			}
			//if (this.strRegularVariant != strVariant.toLowerCase()) str += " " + strVariant;
			this.objTextSizeDimension2.innerHTML = this.getSizeDimension2Text(str);
		}
	},

/**
 * sets the appropriate css class, i.e. soldOut, selected, etc, for color swatches
 * @author yoshi
 */
	setColorSwatches : function() {
		var hlpContext = this;
		/**
		 * sets appropirate btn states base on user selected color/size combo
		 * @param ele
		 * @param index
		 */
		function setColorSwatchesHelper(ele, index) {
			var isSizeAvailable, isOnOrder, isLowInventory, classState;
			var isSoldOut = false, isSelected = false;
			with(hlpContext) {
				isSizeAvailable = isSkuInStock(index, activeSizeDimension1, activeSizeDimension2);
				isOnOrder = isSkuOnOrder(index, activeSizeDimension1, activeSizeDimension2);
				isLowInventory = isSkuLowInventory(index, activeSizeDimension1, activeSizeDimension2);
				isSelected = index == selectedColor;
			}
			isSoldOut = !(isSizeAvailable || isOnOrder || isLowInventory);
			classState = isSoldOut ? (isSelected ? "selectedSoldOut" : "soldOut") : (isSelected ? "selected" : "normal");

			ele.className = classState;
		}
		this.colorButtons.each(setColorSwatchesHelper);
	},

/**
 * sets the appropriate css class, i.e. soldOut, selected, for size btns
 * @param {integer} dim size dimension
 * @param {object} e btn
 * @author yoshi
 */
	setSizeDimensionSwatches : function(dim, e) {
		if(dim == 2 && this.objV.objStyleSizeInfo.intSizeDimensionsCount < 2 ) return;
		this.setSizeDimension = dim;

		var hlpContext = this;
		/**
		 * sets btn states base on user selected color/size combo
		 * @param ele
		 * @param index
		 */
		function setSizeDimensionSwatchesHelper(ele, i) {
			with(hlpContext) {
				var activeDim = setSizeDimension == 1 ? activeSizeDimension2 : activeSizeDimension1;
				var selectedDim = setSizeDimension == 1 ? selectedSizeDimension1 : selectedSizeDimension2;
				var size1 = setSizeDimension == 1 ? i : activeDim;
				var size2 = setSizeDimension == 1 ? activeDim : i;
				var isSizeAvailable = isSkuInStock(activeColor, size1, size2);
				var isOnOrder = isSkuOnOrder(activeColor, size1, size2);
				var isLowInventory = isSkuLowInventory(activeColor,size1, size2);
				var skuReturnType = getReturnCode(activeColor,size1, size2);
				var classState = 'normal';
				if (isSizeAvailable || isOnOrder || isLowInventory) {
					classState = (i == selectedDim ? "selected" : "normal");
				} else {
					classState = (i == selectedDim ? "selectedSoldOut" : "soldOut");
				}
				ele.className = classState;
			}
		}
		this['size' + dim + 'Buttons'].each(setSizeDimensionSwatchesHelper);
	},

/**
 * checks sku color combo for availibility of product
 * @author yoshi
 */
	setSoldOut : function() {
		var isInStock = this.isSkuInStock(this.activeColor,this.activeSizeDimension1,this.activeSizeDimension2);
		var isOnOrder = this.isSkuOnOrder(this.activeColor,this.activeSizeDimension1,this.activeSizeDimension2);
		var isLowInventory = this.isSkuLowInventory(this.activeColor,this.activeSizeDimension1,this.activeSizeDimension2);

		if (this.activeSizeDimension1 == -1 || (this.objV.objStyleSizeInfo.intSizeDimensionsCount == 2 && this.activeSizeDimension2 == -1)) {
			this.showInventoryStatusWindow(false);
				this.setSoldOutMsgStatus("");
		} else {
			if (isOnOrder) {
				this.objInventoryStatusWindow.className = "quickLookOnOrderBkg";
				this.objInventoryStatusWindow.innerHTML = this.getOnOrderWindow(isOnOrder);
				this.showInventoryStatusWindow(true);
				this.setSoldOutMsgStatus("");
			} else if (isLowInventory) {
				this.objInventoryStatusWindow.className = "quickLookLowInventoryBkg";
				this.objInventoryStatusWindow.innerHTML = this.getLowInventoryWindow();
				this.showInventoryStatusWindow(true);
				this.setSoldOutMsgStatus("");
			} else if (isInStock){
				this.showInventoryStatusWindow(false);
				this.setSoldOutMsgStatus("");
			} else {
				this.showInventoryStatusWindow(false);
				this.initializeSoldOutMsg();
				this.setSoldOutMsgStatus(this.getSoldOutBanner());
			}
		}
	},

/**
 * shows the inventory status div
 * @param {boolean} doShow
 * @author yoshi
 */
	showInventoryStatusWindow : function(doShow){
		this.objInventoryStatusWindow.style.display = (doShow ? "block" : "none");
	},

/**
 * sets the sold out msg and show it
 * @param {string} msg
 * @author yoshi
 */
	setSoldOutMsgStatus : function(msg) {
		this.objSoldOutMsg.innerHTML = msg;
		this.objSoldOutMsg.setStyle({visibility : msg != '' ? 'visible' : 'hidden'});
	},

/**
 * checks if current sku color combo is availible, then sets add to bag btn state accordingly
 * @author yoshi
 */
	setInventoryStatus : function() {
		var isInStock = this.isSkuInStock(this.selectedColor,this.selectedSizeDimension1,this.selectedSizeDimension2);
		var isOnOrder = this.isSkuOnOrder(this.selectedColor,this.selectedSizeDimension1,this.selectedSizeDimension2);
		var isLowInventory = this.isSkuLowInventory(this.selectedColor,this.selectedSizeDimension1,this.selectedSizeDimension2);

		if (this.selectedSizeDimension1 == -1 || (this.objV.objStyleSizeInfo.intSizeDimensionsCount == 2 && this.selectedSizeDimension2 == -1)) {
			this.setAddtoBagState(true);
			this.objAddtoBag.alt = this.strAddToBagAltText;
		} else {
			if (isOnOrder || isLowInventory || isInStock){
				this.setAddtoBagState(true);
				this.objAddtoBag.alt = this.strAddToBagAltTextActive;
			} else {
				this.setAddtoBagState(false);
				this.objAddtoBag.alt = this.strAddToBagAltText;
			}
		}
	},

/**
 * generate html for the overview tab on quickLook and outfit, as well as product details on product page
 * @author yoshi
 */
    getOverViewTabHTML : function() {
        var content = {}, romanceCopy = this.objP.arrayInfoTabs[0].strInfoTabDescription, copyContent = [];
        var copyName = brandConst.CopyBox.GROUP_NAME;
        var infoBlockNew = this.templates.INFO_BLOCK_NEW, infoBlockOld = this.templates.INFO_BLOCK_OLD, copyNameDefault = brandConst.CopyBox.GROUP_NAME_DEFAULT;
        var hlpContext = this;

        /**
         * helper function for get getOverViewTabHTML, gets the tab html
         * @param {object} obj accumulator obj
         * @param {object} tab current tab
         * @see getOverViewTabHtML
         * @author yoshi
         */
        function getGroupName(str) {
            if(str.match(/overview/i)) return 'Overview';
            if(str.match(/details/i)) return 'Details';
            if(str.match(/fabric/i)) return 'Fabric';
            if(str.match(/fit/i)) return 'Fit';
            if(str.match(/tips/i)) return 'Tips';
            if(str.match(/care/i)) return 'Care';
        }

		function getTabContentHelper(obj, tab) {
			obj[getGroupName(tab.strInfoTabName)] = hlpContext.getTabContent(tab);
			return obj;
		}

		function getOverviewTabHelper(str, value) {
			if( content[value] != '' ) {
				str.push(infoBlockNew.evaluate({name : copyName[value.replace(/\s/g, '')] ? copyName[value] : copyNameDefault, content : content[value]}));
			}
			return str;
		}

		// set 'Fabric' so it appears at the top of the list.
		content['Fabric'] = (content['Fabric']||'') ;
		// populate content with default data
		content = this.objP.arrayInfoTabs.inject(content, getTabContentHelper);
		// modify the 'Fabric' content to add fabric & care details.
		content['Fabric'] = this.getFabricCare(content['Fabric']||'');
		// Suppress the output of Details, Tips, and Additional Care
		content['Details']= '';
		content['Tips'] = '';
		content['Care']= '';

		if(this.type == 'productPage') {
			if( romanceCopy != '') {
				replaceHTML($('quickLookProductDescription'), '<p class="description">'+ romanceCopy + '</p>').style.marginTop = '8px';
			}
			if(this.objP.objCrossSellInfo) {
				replaceHTML($('crossSellTabWindow'), this.getCrossSellTab());
				this.objCrossSellTab.style.display = "block";
			}
		} else {
			copyContent.push(romanceCopy != '' ? '<p class="description">'+ romanceCopy + '</p>' : '') ;
		}

		Object.keys(content).inject(copyContent, getOverviewTabHelper);
		return copyContent.join('');
	},

	PopWindowObjMap : {productImages:'objProductImagesWindow', productInfo:'objInfoPopUp', sizeChart:'objSizeChartWindow'},

/**
 * this handles pop window
 * @param {string} id name of the child window
 * @param {string} link the url
 * @param {string} params child window params
 * @author yoshi
 */
	popWindow : function(id, link, params) {
		if (this.isLoaded) {
			Object.keys(this.PopWindowObjMap).each(function(name) {
				var childWindow = GID.Browse.Pops[name];
				if(childWindow && !childWindow.window.closed) { childWindow.window.close();}
			});

			var newWin = window.open(link, id, params);
			GID.Browse.Pops[id] = {window: newWin, app : this.type};
			newWin.focus();
		}
	},

/**
 * opens view larger window
 * @author yoshi
 */
	openProductImages : function() {
		var l = (window.screenLeft + 5) || (window.screenX + 5);
		var t = 20;
		this.popWindow('productImages', '/browse/productImages.do', "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width="+this.MOREVIEWSPOPUPWIDTH+",height=768,left="+ l +",top="+ t );
	},

/**
 * opens size char window
 * @author yoshi
 */
	openSizeChart : function() {
		if (!this.objP.sizeChartId || this.objP.sizeChartId == "") { this.objP.sizeChartId = this.DEFAULTSIZECHARTID; }
		this.popWindow('sizeChart', (this.brandCode != gidBrandSiteConstruct.currentBrandCode ? this.brandSite.unsecureUrl : '') + "/browse/sizeChart.do?cid="+ this.objP.sizeChartId, "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,width="+this.SIZECHARTWINDOWWIDTH+",height="+this.SIZECHARTWINDOWHEIGHT);
	},

/**
 * opens a general pop
 * @param {string} strLink  the url
 * @param {integer} w width
 * @param {integer} h height
 */
	openInfoPopUp : function(strLink,w,h) {
		this.popWindow('productInfo', strLink, "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width="+w+",height="+h);
	},

/**
 * initialize the err divs
 * @author yoshi
 */
	initializeFlagErrors : function() {
		var colorPos = Position.cumulativeOffset(this.objTextColor), dimCount = this.objV.objStyleSizeInfo.intSizeDimensionsCount;
		var colorErrMsgDim = this.objColorErrorMsg.getDimensions();
		var dim1Pos = Position.cumulativeOffset(this.objTextSizeDimension1), dim1ErrMsgDim = this.objSizeDimension1ErrorMsg.getDimensions();

		this.objColorErrorMsg.setStyle({left:colorPos[0] - colorErrMsgDim['width'] + 'px',
			top:colorPos[1] + 'px' });

		this.objSizeDimension1ErrorMsg.setStyle({left:dim1Pos[0]-dim1ErrMsgDim['width'] + 'px',
			top: dim1Pos[1] + 'px'});

		if(dimCount == 2 ) {
			var dim2Pos = Position.cumulativeOffset(this.objTextSizeDimension2), dim2ErrMsgDim = this.objSizeDimension2ErrorMsg.getDimensions();
			this.objSizeDimension2ErrorMsg.setStyle({left:dim2Pos[0]-dim2ErrMsgDim['width'] + 'px',
				top: dim2Pos[1] + 'px'});
		}
	},

/**
 * check the see if current sku color combo is availible, validate user input
 * @author yoshi
 */
	checkErrors : function() {
		if (this.intTab == 1 && this.isQuickLookOpen) this.setTab(0); //switches to swatches when displaying errors for quicklook.
		this.initializeFlagErrors();
		var isColor = this.isColorError = this.selectedColor == -1;
		var dimCount = this.objV.objStyleSizeInfo.intSizeDimensionsCount;
		var isDim1Err = this['selectedSizeDimension1'] == -1;

		this.objColorErrorMsg['style']['visisbility'] = isColor ? 'visible' : 'hidden';
		this.isSizeDimension1Error = isDim1Err;
		this.objSizeDimension1ErrorMsg['style']['visibility'] = isDim1Err ? 'visible' : 'hidden';

		if (dimCount == 2) {
			var isDim2Err = this.selectedSizeDimension2 == -1;
			this.isSizeDimension2Error = isDim2Err;
			this.objSizeDimension2ErrorMsg['style']['visibility'] = isDim2Err ? 'visible' : 'hidden';
		}
		this.setBagError();
	},

/**
 * calculates the div position and shows err msgs
 * @author yoshi
 */
	setBagError : function() {
		this.objBagErrorMsg.innerHTML = this.getBagError();
		var dx = $("bagErrorLeft").offsetWidth + $("bagErrorMiddle").offsetWidth + $("bagErrorRight").offsetWidth;
		var pos = Position.cumulativeOffset(this.objAddtoBag);
		var dim = this.objAddtoBag.getDimensions();
		this.objBagErrorMsg.setStyle({left:pos[0]-dx+dim['width'] + 'px', top:pos[1]+dim['height'] + 'px'});

		var showErrMsg = this.isColorError || this.isSizeDimension1Error || this.isSizeDimension2Error;
		this.objBagErrorMsg['style']['visibility'] = showErrMsg ? 'visible' : 'hidden';
		this.objAddtoBag.alt=resourceBundleValues.product.colorAndSizeSelectError;
	},

/**
 * handles when user clicks add to bag btn, fires ajax call to server.
 * ajax returns html to form dropdown bag after eval
 * @author yoshi
 */
	addToBag : function() {
		if (objInlineBag.isOpen || objInlineBag.isAnimating) {
			setTimeout(this.addToBag.bind(this), 250);
		} else {
			this.checkErrors();
			if (!this.isColorError &&
				!this.isSizeDimension1Error &&
				!this.isSizeDimension2Error &&
				(this.isSkuInStock(this.selectedColor,this.selectedSizeDimension1,this.selectedSizeDimension2) || this.isSkuOnOrder(this.selectedColor,this.selectedSizeDimension1,this.selectedSizeDimension2) || this.isSkuLowInventory(this.selectedColor,this.selectedSizeDimension1,this.selectedSizeDimension2))) {

				if (this.objV.objStyleSizeInfo.intSizeDimensionsCount >= 1) {
					var strColorId = this.objV.arrayVariantStyleColors[this.selectedColor].strColorCodeId;
					var strSize1Id = this.arrayAllSizeDimension1[this.selectedSizeDimension1].strId;
					var strSize2Id = "";
				}
				if (this.objV.objStyleSizeInfo.intSizeDimensionsCount == 2) {
					strSize2Id = this.arrayAllSizeDimension2[this.selectedSizeDimension2].strId;
				}
				var strSkuID = this.objV.arrayVariantSkus[strColorId + "_" + strSize1Id + "_" + strSize2Id].strSkuId;

				var inlineBagUrl = this.templates.INLINE_BAG_URL.evaluate({sku:strSkuID, qty:this.strSelectedQty, cid:this.strDefaultCategoryId});
				if (this.hasInlineBagErrors && this.arrayAddtoBagErrors.get(this.objP.strCatalogItemId) &&
                    this.arrayAddtoBagErrors.get(this.objP.strCatalogItemId) == 1) {
					inlineBagUrl += "&addOnOrderItem=true";
					this.hasInlineBagErrors = false;
				}
				objInlineBag.doOpenBag = true;

				// --------------------------------------
				// AJAX INLINE BAG DATA LOADER
				new Ajax.Request(
					inlineBagUrl,
					{
						method: 'get',
						onComplete: this.parseInlineBagAjaxResponse.bind(this)
					}
				);
				// ---------------------------------------
				this.setAddtoBagState(true, true);
			}
		}
	},

/**
 * loads the inline bag html, check for errs, then display it
 * @author yoshi
 */
	loadInlineBag : function() {
        var errors = GID.Buy.Errors.addToBagErrors||[];
        var hasErrs = errors.size() > 0;
        var inlineBagData = GID.Buy.AddToBagData;

        if(hasErrs) {
            this.doAddToBagErrors(($('pageError')||{}).innerHTML, errors);
        }

             if(!hasErrs && inlineBagData){
				var data = objInlineBag.model.data;

				// Create the line item markup
				var lineItems = data.inlineBagItems;
				var lineItemMarkup = '';

				lineItems.each(function(lineItem, count) {

					var imageContent = '';
					if (lineItem.imageURI) {
						var productImageClass = "productThumbnail";
                        if (lineItem.brandCode == '10') {
							productImageClass = "athletaProductThumbnail";
                        }
						imageContent = '<a href="' + lineItem.productLink.unescapeHTML() + '"><img src="/' + lineItem.imageURI + '" class="' + productImageClass + '" alt="' + lineItem.styleDescription + '" /></a>';
					}

					var productNameHref = '';
					var styleDescription = '';

					if (lineItem.styleDescription) {
						productNameHref = lineItem.productLink.unescapeHTML();
						styleDescription = lineItem.styleDescription.unescapeHTML();
					}

					var color = '';
					if (lineItem.colorDescription) {
						color = lineItem.colorDescription;
					}

					var size = '';
					if (lineItem.skuDescription) {
						size = lineItem.skuDescription;
					}

					var listPrice = '';
					var discountedPrice = '';
					var sellPrice = '';
	 				if (lineItem.sellPrice) {
						if (lineItem.listPrice != lineItem.promoDiscountedPrice) {
							listPrice = lineItem.listPrice;
							discountedPrice = lineItem.promoDiscountedPrice;

						} else {
							sellPrice = lineItem.sellPrice;
						}


					}

					var lineItemContent = {
						count:			   count,
						badgeSrc:		   lineItem.brandBadgeSrc,
						badgeAlt:		   lineItem.brandBadgeAlt,
						imageContent:	   imageContent,
						sku:			   lineItem.sku,
						productNameHref:   productNameHref,
						styleDescription:  styleDescription,
						color:			   color,
						size:			   size.unescapeHTML(),
						quantity:		   lineItem.quantity,
						listPrice:		   listPrice,
						discountedPrice:   discountedPrice,
						sellPrice:		   sellPrice,
						subTotal:		   lineItem.itemSubtotal,
						labelColor:		   inlineBag.labelColor,
						labelSize:		   inlineBag.labelSize,
						labelQuantity:     inlineBag.labelQuantity,
						labelPrice:        inlineBag.labelPrice


					};

					lineItemMarkup += GID.Browse.Base.templates.LINE_ITEM.evaluate(lineItemContent);
					
					//set message for ScreenReader
					message = GID.Browse.Base.templates.TEXTREADERMESSAGE.evaluate(lineItemContent);
					inlineBag.setInLineBagMessage(message.unescapeHTML());
					
					
					$('lineItems').update(lineItemMarkup);
				});

				var itemCount = data.itemCount;
				if (itemCount > 1) {
					itemCount += ' ' +inlineBag.itemInPlural + ' ' +inlineBag.lineItemBag; //" items in bag";
				} else {
					itemCount += ' ' +inlineBag.itemInSingular + ' ' +inlineBag.lineItemBag; //" item in bag";
				}
				$('inlineBagSummaryItemCount').update(itemCount);

				$('inlineBagSummarySubPriceLabel').update(data.subTotal);

				objInlineBag.setInlineShoppingBagData(
						inlineBagData.strInlineBagTextClosed + inlineBagData.strBagTextClosedSuffix,
						null,
						inlineBagData.strInlineBagTextOpen);

				this.doAddToBagSuccess(hasErrs);


				// If there is a promo or crosssell
				var inlineBagMarketingContainer = $('gidInlineBagMarketingContainer');
				if(data.addToBagData && data.addToBagData.hasPromotionOrCrossSell == "true") {
					objInlineBag.setInlineShoppingBagMarketing(null);
					inlineBagMarketingContainer.setStyle({display:"none"});
				} else if (inlineBagMarketingContainer && !inlineBagMarketingContainer.empty()){
					objInlineBag.setInlineShoppingBagMarketing(null);
					inlineBagMarketingContainer.setStyle({display:"block"});
				}

                // (Re)Hide all the potential promo types first
				$('gidProductUpsellMessage').hide();
				$('mupUpsellMessage').hide();
				$('gwpPwpSelectionMessage').hide();
				$('selImageLink').hide();
				$('staticPromoTxt').hide();
                $('promoSelLink').hide();

				if (data.hasPromo == "true") {
					var promoType = data.promoType;

					if (promoType == "gidProductUpsellMessage") {
						$('gidProductUpsellMessage').show();

						$('productUpsellMsg').update(data.prodUpSellMsg.unescapeHTML());
						var link = $('productUpsellLink');
						link.onclick = data.promoURI
						link.update(data.promoLinkText);

					} else if (promoType == "mupUpsellMessage") {
						$('mupUpsellMessage').show();
						$('mupUpSellMsg').update(data.upSellMsg);
						$('mupUpSellLink').update(data.upSellLink.unescapeHTML());

					} else if (promoType == "gwpPwpSelectionMessage") {
						$('gwpPwpSelectionMessage').show();

						if (data.selImageURI) {
							$('selImageLink').show();
							$('selImageLink').src = data.selImageURI;
						}

						$('gwpPwpMsg').update(data.gwpPwpMsg);

						var link = $('promoLink');
						link.onclick = data.promoURI;
						link.update(data.promoLinkText);

						if (data.isAutoAdded == "true") {
							$('staticPromoTxt').show();
						} else {
							var selLink = $('promoSelLink');
							selLink.show();
							selLink.update(data.selLink.unescapeHTML());
						}
					}
				} else {
					$('inlineBagPromo').hide();
				}

				if (objInlineBag.model.data.hasCrossSell == "true") {

					Event.observe('inlineBagCrossSell', 'click', function(){window.location.href=objInlineBag.model.data.crossSellURI;});

					if (objInlineBag.model.data.crossSellImagePath) {
						$('crossSellImg').src = objInlineBag.model.data.crossSellImagePath;
					} else {
						$('crossSellImg').hide();
					}

					$('crossSellOutfitMsg').update(objInlineBag.model.data.crossSellOutfitMsg);

					$('inlineBagCrossSell').show();

				} else {
					$('inlineBagCrossSell').hide();
				}

			}

	},

/**
 * parses the add to bag ajax response, then calls loadInlineBag for user feedback
 * @param {object} transport
 * @see loadInlineBag
 * @author yoshi
 */
	parseInlineBagAjaxResponse : function(transport) {
		var response = null;

		response = transport.responseText.replace(/(\n|\r)/g,"");
		try {
			var responseJSON = response.evalJSON();
			objInlineBag.model.data = responseJSON.inlineBagModelData;
			this.updateForInlineBagAjaxResponse();
			setTimeout(this.loadInlineBag.bind(this), 100);
		} catch(e) {
			window.location.href="/";
		}


	},

/**
 * Update javascript data structures and omniture based upon the
 * AJAX response
 * @author Aaron
 */
	updateForInlineBagAjaxResponse : function() {
		if(!(reportingService||{}).isActive){
			if (omni.objDebug.isDebugEnabled && (omni.objDebug.isInlineBagAddDebugEnabled || omni.objDebug.isActivateAllDebugEnabled)) {
				alert("InlineBagAdd Variables:\n\r" +
						"s_pageName = " + (window["s_pageName"] ? s_pageName : "") + "\n\r " +
						"s_products = " + (window["s_products"] ? s_products : "") + "\n\r " +
						"s_eVar5 = " + (window["s_eVar5"] ? s_eVar5 : "") + "\n\r" +
						"s_eVar6 = " + (window["s_eVar6"] ? s_eVar6 : "") + "\n\r" +
						"s_eVar8 = " + (window["s_eVar8"] ? s_eVar8 : "") + "\n\r" +
						"s_eVar13 = " + (window["s_eVar13"] ? s_eVar13 : "") + "\n\r" +
						"s_prop8 = " + (window["s_prop8"] ? s_prop8 : "") + "\n\r" +
						"s_prop9 = " + (window["s_prop9"] ? s_prop9 : "") + "\n\r" +
						"s_prop10 = " + (window["s_prop10"] ? s_prop10 : "") + "\n\r" +
						"s_hier1 = " + (window["s_hier1"] ? s_hier1 : "") + "\n\r" +
						"s_channel = " + (window["s_channel"] ? s_channel : "") + "\n\r" +
						"s_events = " + (window["s_events"] ? s_events : "") + "\n\r");
			}
		}
		//if(!GID.Buy) {GID.Buy = {Errors : {}, AddToBagData : {}}; }
		
		{GID.Buy = {Errors : {}, AddToBagData : {}}; }

		var data = objInlineBag.model.data;

		// Omni related code to track add event.
		if (data.omniInlineBagJS) {
			if(!(reportingService||{}).isActive){
				omni.setAddToBag(data.omniAddToBag, data.omniInlineBagJS);
			}
			else {
				reportingService.controller.viewManagers.inlineBagAddViewManager.controller.getReportRequest(data.omniAddToBag, data.omniInlineBagJS);
			}
		}

		/* line item errors */
		if (data.errorAddToBag) {
            var pageErr = this.objInlineBagError;
            if(pageErr) {
                pageErr.update(data.errorAddToBag.errorMsg);
                pageErr.style.display = 'block';
            }

			GID.Buy.Errors.addToBagErrors = new Hash();

			if (data.errorAddToBag.errors != null) {
				data.errorAddToBag.errors.each(function(newError) {
					GID.Buy.Errors.addToBagErrors.set(newError.key, newError.value);
				});

			}

			var quantity = data.itemCount;

			var inlineBagData = GID.Buy.AddToBagData;

			if (quantity == 1) {
				inlineBagData.strInlineBagTextClosed = quantity + ' '+inlineBag.itemInSingular+'  ';
				inlineBagData.strInlineBagTextOpen = inlineBag.addedTo + ' <a href="/buy/shopping_bag.do">'+inlineBag.yourBag+'</a>';
			} else {
				inlineBagData.strInlineBagTextClosed = quantity + ' '+inlineBag.itemInPlural+'  ';
				inlineBagData.strInlineBagTextOpen = inlineBag.addedTo + ' <a href="/buy/shopping_bag.do">'+inlineBag.yourBag+'</a>';
			}
			inlineBagData.strBagTextClosedSuffix = '<a href="/buy/shopping_bag.do">'+inlineBag.yourBag+'</a>';

		} else {
			var quantity = data.addToBagData.inlineBagQty;

			var inlineBagData = GID.Buy.AddToBagData;

			if (quantity == 1) {
				inlineBagData.strInlineBagTextClosed = quantity + ' '+inlineBag.itemInSingular+'  ';
				inlineBagData.strInlineBagTextOpen = inlineBag.addedTo + ' <a href="/buy/shopping_bag.do">'+inlineBag.yourBag+'</a>';
			} else {
				inlineBagData.strInlineBagTextClosed = quantity + ' '+inlineBag.itemInPlural+'  ';
				inlineBagData.strInlineBagTextOpen = inlineBag.addedTo + ' <a href="/buy/shopping_bag.do">'+inlineBag.yourBag+'</a>';
			}

			inlineBagData.hasPromotionOrCrossSell = data.addToBagData.hasPromotionOrCrossSell;
			inlineBagData.strBagTextClosedSuffix = '<a href="/buy/shopping_bag.do">'+inlineBag.yourBag+'</a>';
		}

	},

/**
 * checks if sku is in stock for given color and size selection
 * @param {integer} color
 * @param {integer} size1
 * @param {integer} size2
 * @param {integer} n
 * @author yoshi
 */
	isSkuInStock : function(color,size1,size2,n) {
		var isInStock = true, isColorInStock = false;
		var objItem = this.getVariantSku(color,size1,size2,n);
		if (n && this.arrayProducts && this.arrayProducts[n]) {
			isColorInStock = (this.arrayProducts[n].objV.arrayVariantStyleColors[color] ? this.arrayProducts[n].objV.arrayVariantStyleColors[color].isInStock : false);
		} else {
			isColorInStock = (this.objV.arrayVariantStyleColors[color] ? this.objV.arrayVariantStyleColors[color].isInStock : false);
		}
		if ((!objItem && (size1 != -1 || size2 != -1)) || !isColorInStock) {
			isInStock = false;
		}
		return isInStock;
	},

/**
 * checks if current product selections is on order
 * @param color
 * @param size1
 * @param size2
 * @param n
 * @author yoshi
 */
	isSkuOnOrder : function(color,size1,size2,n) {
		var isOnOrder = undefined;
		var objSku = this.getVariantSku(color,size1,size2,n);
		if (objSku && objSku.isOnOrder) isOnOrder = objSku.strOnOrderDate;
		return isOnOrder;
	},

/**
 * checks if current product selection is low inventory
 * @param color
 * @param size1
 * @param size2
 * @param n
 * @author yoshi
 */
	isSkuLowInventory : function(color,size1,size2,n) {
		var isLowInventory = false;
		var objSku = this.getVariantSku(color,size1,size2,n);
		if (objSku) isLowInventory = objSku.isLowInventory;
		return isLowInventory;
	},
/**
 * checks if current product selection has return limitations
 * @param color
 * @param size1
 * @param size2
 * @param n
 * @author aliebling
 */
	getReturnCode : function(color,size1,size2,n) {
		var strReturnCode = "";
		var objSku = this.getVariantSku(color,size1,size2,n);
		if (objSku) strReturnCode = objSku.strAllowableReturnCode;
		return strReturnCode;
	},
/**
 * automatically lauch quickLook
 * @param strProductId
 */
	autoLoadProduct : function(strProductId) {
		if (objGIDPageViewAdapter.objGIDProducts.arrayProducts[strProductId] != null)  {
			this.launchQuickLook();
		} else {
			setTimeout("quickLook.autoLoadProduct("+strProductId+")",100);
		}
	},

/**
 * updates html for selected product attributes
 * @author yoshi
 */
	setSelectionConfirmText : function() {
		var objSid = this.objV.arrayVariantStyleColors[this.selectedColor];
		var strColorName = objSid.strColorName;
		var strSizeDimension1 = "", strSizeDimension2 = "", strVariantName = this.objV.strVariantName;

		if (this.selectedSizeDimension1 != -1) {
			strSizeDimension1 = this.arrayAllSizeDimension1[this.selectedSizeDimension1].strName;
		}
		if (this.selectedSizeDimension2 != -1) {
			strSizeDimension2 = this.arrayAllSizeDimension2[this.selectedSizeDimension2].strName;
		}
		this.objSelectedConfirmText.innerHTML = this.getSelectionConfirmText(strColorName,strSizeDimension1,strSizeDimension2,strVariantName);
	},

/**
 * get all the variants skus for current product
 * @param color
 * @param size1
 * @param size2
 * @param n
 * @author yoshi
 */
	getVariantSku : function(color,size1,size2,n) {
		var product, strColorId, strSize1Id, strSize2Id, strMap, objSku;

		if(n && this.arrayProducts[n]) {
			product = this.arrayProducts[n];
			strColorId = (product.objV.arrayVariantStyleColors[color] ? product.objV.arrayVariantStyleColors[color].strColorCodeId : "");
			strSize1Id = (size1 != -1 ? product.arrayAllSizeDimension1[size1].strId : "");
			strSize2Id = (size2 != -1 ? product.arrayAllSizeDimension2[size2].strId : "");
			strMap = strColorId + "_" + strSize1Id + "_" + strSize2Id;
			objSku = product.objV.arrayVariantSkus[strMap];
		} else {
			strColorId = (this.objV.arrayVariantStyleColors[color] ? this.objV.arrayVariantStyleColors[color].strColorCodeId : "");
			strSize1Id = (size1 != -1 ? this.arrayAllSizeDimension1[size1].strId : "");
			strSize2Id = (size2 != -1 ? this.arrayAllSizeDimension2[size2].strId : "");
			strMap = strColorId + "_" + strSize1Id + "_" + strSize2Id;
			objSku = this.objV.arrayVariantSkus[strMap];
		}
		return objSku;
	},

	/**
	 * setter for price text
	 * @authoer yoshi
	 */
	setPriceText : function() {
		var strPrice, strSalePrice;
		if (this.objP.isGiftCard) {
			var objSku = this.getVariantSku(this.selectedColor,this.selectedSizeDimension1,this.selectedSizeDimension2);
			if (objSku && objSku.strRegularPrice) {
				strPrice = objSku.strRegularPrice;
				strSalePrice = (this.objV.arrayVariantStyleColors[this.selectedColor].isOnSale ? objSku.strCurrentPrice : "" );
				this.objPriceText.innerHTML = this.getPriceText(strPrice,strSalePrice);
			}
		} else {
			var objSid = this.objV.arrayVariantStyleColors[this.selectedColor];
			strPrice = objSid.strRegularPrice;
			strSalePrice = (objSid.isOnSale ? objSid.strSalePrice : "" );
			this.objPriceText.innerHTML = this.getPriceText(strPrice,strSalePrice);
		}
	},

	/**
	 * check to see if theres MUP message attached to the current product, then sets the style accordingly
	 * @author yoshi
	 */
	initializePromotions : function() {
		if (this.objP.strMupMessage && this.objP.strMupMessage.length > 0) {
			this.objStyleMupMessage.innerHTML = this.objP.strMupMessage;
			this.objStyleMupMessage.style.display = "block";
		}
	},

	/**
	 * initialize sold out msg div css position
	 * @author yoshi
	 */
	initializeSoldOutMsg : function(target) {
		var pos = Position.cumulativeOffset(this.p1ImageHolder);
		this.objSoldOutMsg.setStyle({
			left : pos[0]+this.SOLDOUTMSGDX + 'px',
			top: pos[1]+this.SOLDOUTMSGDY + 'px' });
	},

	/**
	 * poputlates the select qty dropdown box
	 * @author yoshi
	 */
	setQtyDropDown : function() {
		this.objQtyDropDown.options.length = 0;
		var maxQty = Math.max(this.objP.intMaxQuantity, this.strSelectedQty);
		for ( var i=1;i<= maxQty;i++) {
			this.objQtyDropDown.options[this.objQtyDropDown.length] = new Option(i,i);
		}
		this.objQtyDropDown.selectedIndex = Number(this.strSelectedQty)-1;
	},

	/**
	 * save select qty value from dropdown
	 * @author yoshi
	 */
	setSelectedQty : function() {
		this.strSelectedQty = this.objQtyDropDown.options[this.objQtyDropDown.selectedIndex].value;
	},

	/**
	 * Constructs the productDataUrl for a given request.
	 * @author Andrew Southwick
	 */
	getProductDataUrl:function(strProductId, strVariantId, strStyleColorId, currentLocale) {
		var productDataUrl =
			this.templates.PRODUCT_DATA_URL.evaluate({pid:strProductId||'', vid:strVariantId||'',
				scid:strStyleColorId||'', type:this.strDisplayType ? '&displayType=' + this.strDisplayType : '',
						actFltr:this.isFromSBS, localeCode:currentLocale});
		if (brandConst.CATALOG_2_ACTIVE == 'true') {
			var productStyleSourceFlag = getQuerystringParam("productStyleSourceFlag");
			if (productStyleSourceFlag != "") {
				productDataUrl = productDataUrl + "&productStyleSourceFlag=" + productStyleSourceFlag;
			}
		}
		return productDataUrl;
	},

	/**
	 * fires ajax request to productData.do. not using the default callback function because the return script could contain
	 * a <scriptHolder> tag, which replaces the <script> tag to get around NIS
	 *
	 * depends on whether the current product is from the current brand, instead of an ajax request, it creates dynamic script
	 * tag to load in the data for cross domain data fetch, such as BR requesting ON product info
	 *
	 * @param strProductId
	 * @param dataLoaderAction
	 * @param strVariantId
	 * @param strStyleColorId
	 * @param productBrandCode
	 */
	loadProductData : function(strProductId,dataLoaderAction,strVariantId,strStyleColorId,productBrandCode) {
		if( strProductId == 0 ) return;
		this.productId = strProductId; this.variantId = strVariantId;
		this.dataLoaderAction = dataLoaderAction;
		var currentLocale = brandConst.BRAND_LOCALE;
		var productDataUrl = this.getProductDataUrl(strProductId, strVariantId, strStyleColorId, currentLocale);
		if (!productBrandCode || productBrandCode == gidBrandSiteConstruct.currentBrandCode ) {
			new Ajax.Request(
				productDataUrl,
				{
					method: 'get',
					onComplete: this.parseProductDataAjaxResponse.bind(this)
				}
			);
		} else {
			var gidBrand = gidBrandSiteConstruct.gidBrandSites[parseInt(productBrandCode)];
			if (gidBrand) {
				var args = {strProductId:strProductId};
				gidLib.loadScript({
					callerObject:this,
					src:gidBrand.unsecureUrl + productDataUrl,
					timeout:{
						handler:this.loadScriptTimeoutHandler.bind(this),
						args:args,
						timeDelay:20
					},
					callback:{
						handler:this.loadScriptCallbackHandler.bind(this),
						args:args,
						timeDelay:0.1
					}
				});
			}
		}
	},

	/**
	 * err handler when cross domain product load times out
	 * @param args
	 */
	loadScriptTimeoutHandler:function(args) {
		var timedOut = false;
		if (!objGIDPageViewAdapter.objGIDProducts.arrayProducts[args.strProductId]) {
			alert("foreign url failed to load");
			timedOut = true;
		}
		return timedOut;
	},

	/**
	 * call back function for successful cross domain data fetch
	 * @param args
	 * @param periodicalExecuterRef
	 */
	loadScriptCallbackHandler:function(args,periodicalExecuterRef) {
		var loadSuccess = false;
		if (objGIDPageViewAdapter.objGIDProducts.arrayProducts[args.strProductId]) {
			this.dataLoaderCall();
			periodicalExecuterRef.stop();
			loadSuccess = true;
		}
		return loadSuccess;
	},

	/**
	 * initialize data using the correct data loader action
	 * initial - product page
	 * auto - quicklook
	 * variant - variant
	 * next - outfit?
	 */
	dataLoaderCall : function() {
		switch(this.dataLoaderAction) {
				case "initial":
					this.initializeProduct(this.productId);
					break;
				case "auto":
					this.autoLoadProduct(this.productId);
					break;
				case "next":
					this.loadNextProduct();
					break;
				case "variant":
					this.loadVariantProduct(this.productId, this.variantId);
					break;
		}
	},

	/**
	 * call back function for product data ajax request
	 * @param transport
	 */
	parseProductDataAjaxResponse : function(transport) {
		var response = transport.responseText;
		eval(response);

		if(GID.Browse.Errors.isProductDataError) {
			this.productDataError();
		}

		this.dataLoaderCall();
	},
	/**
 	* loadVariantProduct - Handles the loading of Variant per product variant types:petite, regular, tall
 	* This is a method of class ViewLarger
 	* @param {string} strProductId Product ID
 	* @param {string} strVariantId Variant Type
 	* Modified:  Keo 12/04/07 - Added Comments
 	* @author Unkown
 	*/
	loadVariantProduct : function(strProductId,strVariantId) {
		this.p1Image.src = '/assets/common/navigation/en/indicator-large.gif';
		if (objGIDPageViewAdapter.objGIDProducts.arrayProducts[strProductId] == null)  {
			if (strVariantId) {
				this.loadProductData(strProductId,"variant",strVariantId);
			} else {
				this.loadProductData(strProductId,"variant");
			}
		} else if (strVariantId && !objGIDPageViewAdapter.objGIDProducts.arrayProducts[strProductId].arrayVariantStyles[strVariantId].isLoaded) {
				this.loadProductData(strProductId,"variant",strVariantId);
		} else {
			this.initializeVariant(strProductId,strVariantId);
		}
	},

	/**
	 * data loader for quicklook related components
	 */
	loadNextProduct : function() {
		var strProductId = this.objP.arrayVariantProducts[this.intDataLoadCounter].strCatalogItemID;
		if (objGIDPageViewAdapter.objGIDProducts.arrayProducts[strProductId] != null)  {
			this.intDataLoadCounter++;
			this.postLoadData();
		} else {
			setTimeout("quickLook.loadNextProduct()",100);
		}
	},

	/**
	 * sets the css for the corresponding marketing flags
	 */
	initializeMarketingFlags : function() {
		var objP = this.objP, objV = this.objV;
		if (objP.hasMarketingFlag && objP.objMarketingFlag) {
			this.objStyleMarketingFlag.innerHTML = this.getMarketingFlag(objP.objMarketingFlag);
			this.objStyleMarketingFlag.style.display = "block";
		} else {
			this.objStyleMarketingFlag.style.display = "none";
		}
		if (objP.hasMarketingCallOut && objP.objMarketingCallOut) {
			this.objStyleMarketingCallOut.innerHTML = this.getMarketingFlag(objP.objMarketingCallOut);
			this.objStyleMarketingCallOut.style.display = "block";
		} else {
			this.objStyleMarketingCallOut.style.display = "none";
		}
		this.hasStyleColorMarketingFlag = false;
		this.objStyleColorMarketingFlag.style.display = "none";
		var variantColorLen = this.objV.arrayVariantStyleColors.length;
		var variantStyleColors = this.objV.arrayVariantStyleColors;

		for (var i=0;i<variantColorLen;i++) {
			if (variantStyleColors[i].objMarketingFlag != undefined) {
				this.hasStyleColorMarketingFlag = true;
				this.objStyleColorMarketingFlag.style.display = "block";
			}
		}
		this.hasSkuMarketingFlag = false;
		this.objSkuMarketingFlag.style.display = "none";
		var obj = this;
		Object.values(objV.arrayVariantSkus).each(function(sku) {
			if(sku && sku.objMarketingFlag) {
				obj.hasSkuMarketingFlag = true;
				obj.objSkuMarketingFlag.setStyle({display:'block',
					width: (objV.objStyleSizeInfo.intSizeDimensionsCount >= 1 ? obj.INT2SIZEMAXWIDTH : obj.INT1SIZEMAXWIDTH) + "px"});
			}
		});
	},

	updateMarketingFlags : function() {
		var activeColor = this.objV.arrayVariantStyleColors[this.activeColor], marketingFlag = activeColor.objMarketingFlag;
		if (this.hasStyleColorMarketingFlag) {
			this.objStyleColorMarketingFlag.innerHTML = marketingFlag ? this.getMarketingFlag(marketingFlag) : '';
		}
		if (this.hasSkuMarketingFlag && marketingFlag != undefined) {
			var strKey = activeColor.strColorCodeId + "_", dimCount = this.objV.objStyleSizeInfo.intSizeDimensionsCount;
			var str = "";
			if ( dimCount >= 1 && this.activeSizeDimension1 != -1) {
				strKey += this.arrayAllSizeDimension1[this.activeSizeDimension1].strId;
			}
			strKey += "_";
			if (dimCount == 2 && this.activeSizeDimension2 != -1) {
				strKey += this.arrayAllSizeDimension2[this.activeSizeDimension2].strId;
			}
			if (this.objV.arrayVariantSkus[strKey] && this.objV.arrayVariantSkus[strKey].objMarketingFlag) {
				str = this.getMarketingFlag(this.objV.arrayVariantSkus[strKey].objMarketingFlag);
			}
			this.objSkuMarketingFlag = replace(this.objSkuMarketingFlag,str);
		} else {
			this.objSkuMarketingFlag.innerHTML = '';
		}
	},
	/**
	 * setReturnDivs - Checks for for the allowed return type and displays the appropriate div.
	 * @author aliebling 05/12/2009
	 */
	setReturnDivs : function() {
		// Determine the divs we are working with
		var objMailOnlyDiv;
		if (this.isQuickLookOpen){
			objMailOnlyDiv = $('productMailOnlyReturn2');
		} else {
			objMailOnlyDiv = $('productMailOnlyReturn');
		}

		var objNonreturnableDiv;
		if (this.isQuickLookOpen){
			objNonreturnableDiv = $('productNonreturnable2');
		} else {
			objNonreturnableDiv = $('productNonreturnable');
		}
			
		var objFreeReturnsDiv;
		if (this.isQuickLookOpen){
			objFreeReturnsDiv = $('productFreeReturn2');
		} else {
			objFreeReturnsDiv = $('productFreeReturn');
		}
			
		// Reset all divs to display: none		
		objMailOnlyDiv.setStyle({display: 'none'});
		objNonreturnableDiv.setStyle({display: 'none'});
		objFreeReturnsDiv.setStyle({display: 'none'});
	
		// Prepare for multi objects by retrieving the sku specific returnType
		multi = this.objP.strAllowableReturnCode == "Multi";
		var skuReturnType;
		if(multi){
			with(this) {
				skuReturnType = getReturnCode(activeColor,activeSizeDimension1, activeSizeDimension2);
			}
		}

		if(this.objP.strAllowableReturnCode && this.objP.strAllowableReturnCode != ""){
			if(this.objP.strAllowableReturnCode == "M" ||
					(multi && skuReturnType == "M")
			){
				objMailOnlyDiv.setStyle({display: 'block'});
			} else if(this.objP.strAllowableReturnCode == "N" ||
					(multi && skuReturnType == "N")
			){
				objNonreturnableDiv.setStyle({display: 'block'});
			} else if(this.objP.strAllowableReturnCode == "F" ||
					(multi && skuReturnType == "F")
			){
				objFreeReturnsDiv.setStyle({display: 'block'});
			}
		}
	},
	/**
	 * setter for orgin copy in the fabric details bullet
	 */
	setProductOriginCopy : function() {
		this.objProductOriginCopy.innerHTML = this.getProductOrigin();
	},
	
	/**
	 * setProductVendorInfo sets the appropriate vendor information.  Piperlime products display the vendorProductId.
	 * 
	 * Modified 7/28/2009 Krishna Rangavajhala PLA-211 vendor product id is always expected to be available. Therefore, cleaned up displaying vendorstylenumber otherwise.
	 * @author Byung 4/21/09
	 */
	setProductVendorInfo : function() {
		var element = $(this.objProductVendorInfo);
		var id = "";
		if (element) {
	    	if (this.brandCode == 4) {
	    		var activeColor = this.objV.arrayVariantStyleColors[this.activeColor];
	    		if (activeColor) id = activeColor.strVendorProductId;
			} else {
				id = this.objP.strVendorId;
			}
		}
		if (id != "") {
			element.update(brandProperties.VENDORIDSYMBOL + id);
			element.show();
		}
	},

	/**
	 * after initialize color, colorcylinghelper is called to run through all the colors to find the next availible color
	 * size combo.  if the user selected color is not availible for the user selected size, the next availible color will be
	 * chosen.
	 */
	initializeColorCycling : function() {
		var isInStock = this.isSkuInStock(this.selectedColor,this.selectedSizeDimension1,this.selectedSizeDimension2);
		var isOnOrder = this.isSkuOnOrder(this.selectedColor,this.selectedSizeDimension1,this.selectedSizeDimension2);
		var isLowInventory = this.isSkuLowInventory(this.selectedColor,this.selectedSizeDimension1,this.selectedSizeDimension2);
		this.objV.arrayVariantStyleColors.selectedIndex = -1;

		/**
		 * helper function for initialize color cycling
		 */
		var hlpContext = this;
		function colorCyclingHelper() {
			with(hlpContext)  {
				var len = objV.arrayVariantStyleColors.length, i=selectedColor+1, isInStock,isOnOrder, isLowInventory;
				if(len == 1) {return 0;}
				if(i >= len ) { i = 0; }
				while(i != selectedColor) {
					isInStock = isSkuInStock(i, selectedSizeDimension1, selectedSizeDimension2);
					isOnOrder = isSkuOnOrder(i, selectedSizeDimension1, selectedSizeDimension2);
					isLowInventory = isSkuLowInventory(i, selectedSizeDimension1, selectedSizeDimension2);

					if(isInStock||isOnOrder||isLowInventory) { break;}
					i++;
					if(i == len) { i = 0; }
				}

				return i;
			}
		}
		if(!isInStock && !isOnOrder && !isLowInventory) {
			this.selectedColor = this.activeColor = colorCyclingHelper();
			this.selectedColorName = this.objV.arrayVariantStyleColors[this.selectedColor].strColorName;
		}
	},

	/**
	 * goto an outfit page when crosssell outfit img is clicked. store a cookie to keep track of the clickthrough product
	 * for omniture
	 */
	goOutfit : function() {
		var strLink = this.objP.objCrossSellInfo.strLink;
		if (this.isFromSBS) strLink += this.strSBSUrlSuffix;
		var strCookieVal = this.objP.strProductId + "," +
							this.objV.strVariantId + "," +
							this.selectedColor + "," +
							this.selectedSizeDimension1 + "," +
							this.selectedSizeDimension2 + "," +
							this.strSelectedQty;
		setCookieVar("globalSession","selectionData",strCookieVal);
		setCookieVar('globalSession', 'omniClickThrough', this.objP.strProductId);	  //project selfesteem-story #29
		window.location.href = strLink;
	},

	/**
	 * if any of the crossell product is clicked, it sets a cookie to keep track of clickthrough product
	 * @param id
	 */
	goCrossSell : function(id) {
		var crossSellProduct = objGIDPageViewAdapter.objGIDProducts.arrayProducts[id]||{};
		if(!crossSellProduct.crossSellFired) {
			setCookieVar('globalSession', 'omniClickThrough', this.crossSellId);
			crossSellProduct.crossSellFired = true;
		}
	},

	/**
	 * initialize the default size selection, if there is one
	 */
	initializeSkuSelection : function() {
		var obj = this;
		var skus = this.objV.arrayVariantSkus;
		var defaultVariant =
				Object.keys(skus).find(
						function(sku){return sku && skus[sku].strSkuId == obj.strDefaultSkuId;}
						);

		if(defaultVariant) {
			defaultVariant = defaultVariant.split('_');
		   this.selectedColor = this.objV.arrayVariantStyleColors.findIndex(
				function(color) {
					return color.strColorCodeId == defaultVariant[0];
				}
			)||0;

		   this.selectedSizeDimension1 = this.arrayAllSizeDimension1.findIndex(
				function(size1) {
					return size1.strId == defaultVariant[1];
				}
			)||0;

			if(this.objV.objStyleSizeInfo.intSizeDimensionsCount == 2) {
				this.selectedSizeDimension2 = this.arrayAllSizeDimension2.findIndex(
					function(size2) {
						return size2.strId == defaultVariant[2];
					}
				)||0;
			}
		}
		this.activeColor = this.selectedColor;
		this.activeSizeDimension1 = this.selectedSizeDimension1;
		this.activeSizeDimension2 = this.selectedSizeDimension2;
	},

	/**
	 * close all the pops when closing quicklook or leaving productpage
	 */
	closeRelatedWindows : function() {
		if (this.objProductImagesWindow && !this.objProductImagesWindow.closed) this.objProductImagesWindow.close();
		if (this.objSizeChartWindow && !this.objSizeChartWindow.closed) this.objSizeChartWindow.close();
		if (this.objInfoPopUp && !this.objInfoPopUp.closed) this.objInfoPopUp.close();
	},

	/**
	 * if ur coming from Shop by size this will initialize the corret user selected size dimension and makes it default selection
	 * @param cat
	 * @param dim
	 */
	getUserSizeSelection : function(cat,dim) {
		var strDimVal = '';
		if (this.isFromSBS) {
			var objUserSizeSelections = this.objUserSizeSelections;
			var strKey = cat + "," + dim;
			var arrayAllSizeDim = dim == '1' ? this.arrayAllSizeDimension1 : this.arrayAllSizeDimension2;

			if (objUserSizeSelections && objUserSizeSelections.arraySizeCategories[strKey]) {
				strDimVal = objUserSizeSelections.arraySizeCategories[strKey].strSizeDimensionValueId;
				if (objUserSizeSelections.arraySizeCategories[strKey].strSizeDimensionAlphaSize != "") {
					var strEquivalentSizes = ","+objUserSizeSelections.arraySizeCategories[strKey].strSizeDimensionAlphaSize.replace(/\s/g,"") + ",";
					arrayAllSizeDim.inject(strDimVal,
								function(str, value, index) {
									if (strEquivalentSizes.indexOf("," + value.strName + ",") != -1) {
										str += "," + value.strId;
									}
									return str;
								}
							)
				}
				strDimVal += ",";
			}
		}
		return strDimVal;
	},

	setAddtoBagState : function(bln, isDisabled) {
		this.getAddtoBag(bln, isDisabled);
	},

	/**
	 * update text info base on user selection
	 */
	updateDataLabels : function() {
		this.setTextSizeDimension1();
		this.setTextSizeDimension2();
		this.setTextColor();
		this.setSelectionConfirmText();
		this.setPriceText();
		this.setSoldOut();
		this.setInventoryStatus();
		this.updateMarketingFlags();
		this.setReturnDivs();
		this.setProductVendorInfo();
	},

	/**
	 * err handler when add to bag ajax request comes back with errors
	 * @param strPageError
	 * @param arrayLineItemErrors
	 */
	doAddToBagErrors : function(strPageError,arrayLineItemErrors) {
		this.setAddToBagError(strPageError);
		if (arrayLineItemErrors.size() > 0) {
			this.hasInlineBagErrors = true;
			this.arrayAddtoBagErrors = arrayLineItemErrors;
		}
		this.setAddtoBagState(true);
	},

	/**
	 * sets css when add to back err is detected
	 * @param strPageError
	 */
	setAddToBagError : function(strPageError) {
        if(!strPageError) return;
		this.objInlineBagError.innerHTML = strPageError;
		if (this.objInlineBagError.style) this.objInlineBagError.style.display = "block";
	},

	/**
	 * hides the err div
	 */
	clearAddToBagError : function() {
		if (this.objInlineBagError) {
			this.objInlineBagError.innerHTML = "";
			if (this.objInlineBagError.style) this.objInlineBagError.style.display = "none";
		}
	},

	/**
	 * sets css for GID promo msg accordingly
	 */
	setGIDPromoMessage : function() {
		if (this.objP.strGIDPromoMessage && this.objP.strGIDPromoMessage != "") {
			this.objGIDPromoMessage = replaceHTML(this.objGIDPromoMessage, this.objP.strGIDPromoMessage);
			this.objGIDPromoMessage.style.display = "block";
		} else {
			this.objGIDPromoMessage.style.display = "none";
		}
	},

	/**
	 * success handler when add to bag ajax request is done
	 */
	doAddToBagSuccess : function(hasErr) {
		this.setAddtoBagState(true);
        if(!hasErr) {
            this.clearAddToBagError();
            this.arrayAddtoBagErrors._objects = {};
        }
        window.scrollTo(0,0);
		if (objInlineBag.doOpenBag) objInlineBag.openInlineBag();
		if (this.isQuickLookOpen) this.closeQuickLook();
	},

	/**
	 * if ajax request failed, displays general no results page
	 */
	productDataError : function() {
		window.location.replace("/browse/GeneralNoResults.do");
	},

	/**
	 * initialize/cache dom reference to all interactive buttons for performance reasons
	 */
	setSwatchButtons : function() {
		this.size1Buttons = Element.getElementsBySelector(this.size1Swatches ,
			'button');
		this.size2Buttons = Element.getElementsBySelector(this.size2Swatches ,
			'button');
		this.colorButtons = Element.getElementsBySelector(this.colorSwatches ,
			'input[type="image"]');
	},

	/**
	 * generates html for the moreviews btn
	 */
	 getProductImageTools : function() {
		return this.objV.arrayVariantStyleColors[0].hasLargerImage || this.objP.hasAlternateImage ?
					this.templates.MORE_VIEWS.evaluate({btnPath : this.resources.BTN_PATH, app : this.type}) : '';
	},

	/**
	 * generates html for product name
	 * @param brandName
	 * @param styleName
	 */
	getProductNameText : function(brandName, styleName) {
		return '<span class="productBrand">'+brandName+'</span> <span class="productName">' + styleName + '</span>';
	},

	/**
	 * setter for productname html
	 */
	setProductNameText : function() {
		this.objProductNameText.innerHTML = this.getProductNameText(this.objP.strVendorName, this.objP.strProductStyleName);
	},

	/**
	 * prepares the price array for price point sort
	 * @param array
	 * @param color
	 * @param index
	 */
	addPriceHelper : function(array, color, index) {
			var price = 0;
				if(color.strPartialMupMessage!=''){
						//price = Number(color.strRegularPrice.substring(1));
						price = this.getPriceDigits(color.strRegularPrice);
				} else if( color.strSalePrice) {
						//price = Number(color.strSalePrice.substring(1));
						price = this.getPriceDigits(color.strSalePrice);
				} else if( color.strRegularPrice ) {
					//price = Number(color.strRegularPrice.substring(1));
					price = this.getPriceDigits(color.strRegularPrice);
				}
			color.index = index;
			color.price = price;
			array.push(price);
			return array;
		},
	/**
	 * This method is returns the price digits only
	 */
	getPriceDigits : function(price){
			var currencySignIndex = price.indexOf(resourceBundleValues.currency);
			var productPrice = price;
			if(currencySignIndex != -1 ){
				productPrice = price.replace(resourceBundleValues.currency,'');
			}
			productPrice = productPrice.replace(/[^\d.,]+/,'');
			return productPrice; 
		},
		
	sortNumber : function(a,b) { return b-a; },

	/**
	 * finds all the color variants that has the same price
	 * @param array
	 * @param price
	 * @param index
	 */
	groupPriceHelper : function(array, price, index) {
		array.push(this.objV.arrayVariantStyleColors.findAll(
			function(color) {
				return color.price == price;
			}
		));
		return array;
	},

	/**
	 * groups color array base on price, uses stable sort to keep original color order
	 */
	generatePricePoints : function() {
		var objV = this.objV;
		if(!objV.isStyleColorSorted) {
			var tmpArray1 = [], tmpArray2 = [];
			objV.pricePoints = objV.arrayVariantStyleColors.inject(tmpArray1,
					this.addPriceHelper.bind(this)).uniq();
			objV.arrayVariantStyleColors = objV.pricePoints.sort(this.sortNumber).inject(tmpArray2, this.groupPriceHelper.bind(this)).flatten();
			objV.defaultVariantStyleColor = objV.arrayVariantStyleColors.findIndex(function(color) {return color.index == 0;});
			objV.isStyleColorSorted = true;
		}
	},

	/**
	 * clears all states for the current product, clear user selected attributes
	 */
	purgeDataObjects : function() {
		this.arrayAllSizeDimension1.length = 0;
		this.arrayAllSizeDimension2.length = 0;

		this.intTab = 0;
		//this.activeColor = -1;
		this.activeSizeDimension1 = -1;
		this.activeSizeDimension2 = -1;

		//this.selectedColor = -1;
		this.selectedSizeDimension1 = -1;
		this.selectedSizeDimension2 = -1;

		this.isColorError = false;
		this.isSizeDimension1Error = false;
		this.isSizeDimension2Error = false;
		this.isBagError = false;
	},

	/**
	 * clear all err flags and hides err div
	 */
	clearErrors : function() {
		[this.objColorErrorMsg, this.objSizeDimension1ErrorMsg, this.objSizeDimension2ErrorMsg,
			this.objBagErrorMsg].invoke('setStyle',{visibility:'hidden'});
		this.isColorError = this.isSizeDimension1Error = this.isSizeDimension2Error = false;
	},

	/**
	 * initialize the product variant, a variant is tall, petite, or regular
	 * @param strProductId
	 * @param strVariantId
	 */
	initializeVariant : function(strProductId,strVariantId) {
		this.purgeDataObjects();
		this.clearErrors();
		this.initializeData(strProductId,strVariantId);
		if (window['productPage']) {
			this.setVariantToReportingService(strVariantId);
		}
	},

	/**
	 * contains methods that are used to initialize all components
	 */
	initializeCoreComponents : function() {
		this.generatePricePoints();
		this.initializeColors();
		this.initializeSizeDimension1();
		this.initializeSizeDimension2();
		this.initializeColorCycling();
		this.initializeImages();
	},

	/**
	 * sets variant product info to the reporting service
	 */
 	setVariantToReportingService : function(strVariantId) {
		if((reportingService||{}).isActive) {
            if (window['productPage']) {
				var controller = reportingService.controller.viewManagers.productpageViewManager.controller;
			} else if (window['quickLook']) {
				var controller = reportingService.controller.viewManagers.commonViewManager.controller;	
			}
			controller.setReportModel(strVariantId);
			controller.setReportTransmissionVars();
			this.setReportingService();	
		}
	},
	/**
	 * creates a ProductImages obj for the current variant.
	 * NOTE: idealy each product should have 1 productImages obj, right now each variant has one which
	 * is inefficient
	 * however theres noway to know all the colors availible for each variant until the ajax data is return
	 */
	initializeImages : function() {
		var objV = this.objV;
		if(!objV.ProductImages) {
			objV.ProductImages = new ProductImages();
			objV.ProductImages.init(this.objP, this);
		}
	},

	/**
	 * search for the default selected color base on the following order:
	 * cookie -> if quicklook use quicklook default color -> if theres default color use it -> user selected color
	 */
	initializeColors : function() {
		this.selectedColor = this.objV.defaultVariantStyleColor;
		var colorLen = this.objV.arrayVariantStyleColors.length, styleColors = this.objV.arrayVariantStyleColors, i=0;

		if (this.objCookieData.color != -1) {
			for (i=0;i<colorLen;i++) {
				if (styleColors[i].strColorName == this.objCookieData.color) {
					this.selectedColor = i; break;
				}
			}
		}

		if(this.objQuickLookTarget && this.objQuickLookTarget.strDefaultStyleColor != -1 && this.objQuickLookTarget.strDefaultStyleColor != '') {
			for (i=0;i<colorLen;i++) {
				if (styleColors[i].strColorCodeId == this.objQuickLookTarget.strDefaultStyleColor) {
					this.selectedColor = i;
					break;
				}
			}
		}

		if (this.strDefaultStyleColorId != -1) {
			for (i=0;i<colorLen;i++) {
				if (styleColors[i].strColorCodeId == this.strDefaultStyleColorId)
				this.selectedColor = i;
			}
		}

		if (this.selectedColorName != "") {
			for (i=0;i<colorLen;i++) {
				if (styleColors[i].strColorName == this.selectedColorName) {
					this.selectedColor = i;
					break;
				}
			}
		}
		this.activeColor = this.selectedColor;
		this.selectedColorName = this.objV.arrayVariantStyleColors[this.selectedColor].strColorName;
	},

	/**
	 * keeps a string to keep track of equivalent sizes, like a Small means size 0-6, and Medium is 7-9 so on
	 * SBS only
	 * @param cat
	 * @param dim
	 */
	setEquivalentSizes : function(cat, dim) {
		if (this.isFromSBS) {
			var objUserSizeSelections = this.objUserSizeSelections;
			var strKey = cat + ',' + dim;
			if (objUserSizeSelections && objUserSizeSelections.arraySizeCategories[strKey]) {
				this.selectedSize = objUserSizeSelections.arraySizeCategories[strKey].strSizeDimensionValueId + ',';
				if (objUserSizeSelections.arraySizeCategories[strKey].strSizeDimensionAlphaSize != "") {
					this.strEquivalentSizes = ","+objUserSizeSelections.arraySizeCategories[strKey].strSizeDimensionAlphaSize.replace(/\s/g,"") + ",";
				}
			}
		 }
	},

	/**
	 * initialize size dimension1
	 * @see initializeDim1Helper
	 */
	initializeSizeDimension1 : function() {
		var objV = this.objV, sizeInfo = objV.objStyleSizeInfo, dimCount = sizeInfo.intSizeDimensionsCount;
		var hlpContext = this;
		/**
		 * helper function for initializing size 1 skus
		 * @param str
		 * @param size
		 * @param index
		 */
		function initializeDim1Helper(str, size, index) {
			hlpContext.arrayAllSizeDimension1.push({strName:size[0], strId:size[1]});
			var strEquivalentSizes = hlpContext.strEquivalentSizes;

			if (strEquivalentSizes && strEquivalentSizes.indexOf("," + size[0] + ",") != -1) {
				str += "," + size[1];
			}

			if ( (str.indexOf(size[1]) != -1 && hlpContext.previouseSelectedSize1 == -1) || (hlpContext.previouseSelectedSize1 == size[0])  ) {
				hlpContext.selectedSizeDimension1 = index;
			}

			return str;
		}

		if (dimCount >= 1) {
			this.selectedSize = '';
			this.setEquivalentSizes(sizeInfo.intSizeCategoryId,sizeInfo.strSizeDimension1Id);
			var dimArray = this.arrayAllSizeDimension1;
			this.previouseSelectedSize1 = this.selectedSizeDimension1Name || this.objCookieData.s1;
			sizeInfo.strSizeDimension1ListOptions.split("||").invoke('split', '^,^').inject(this.selectedSize, initializeDim1Helper);

			if(dimArray.size() == 1) { this.selectedSizeDimension1 = 0; }
			if(sizeInfo.hasSizeDimension1Default) { this.selectedSizeDimension1 = sizeInfo.strDefaultSizeDimension1SizeCodeID; }
			this.activeSizeDimension1 = this.selectedSizeDimension1;
			if (dimArray[this.selectedSizeDimension1]) { this.selectedSizeDimension1Name = dimArray[this.selectedSizeDimension1].strName; }
		} else { this.selectedSizeDimension1 = this.activeSizeDimension1 = -1; }
	},

	/**
	 * initialize size dimension2
	 * @see initializeDim2Helper
	 */
	initializeSizeDimension2 : function() {
		var objV = this.objV, sizeInfo = objV.objStyleSizeInfo, dimCount = sizeInfo.intSizeDimensionsCount;
		var hlpContext = this;
		/**
		 * helper functions for initializing size 2 skus
		 * @param str
		 * @param size
		 * @param index
		 */
		function initializeDim2Helper(str, size, index) {
			hlpContext.arrayAllSizeDimension2.push({strName: size[0], strId: size[1]});
			var strEquivalentSizes = hlpContext.strEquivalentSizes;

			if (strEquivalentSizes && strEquivalentSizes.indexOf("," + size[0] + ",") != -1) {
				str += "," + size[1];
			}

			if ( (str.indexOf(size[1]) != -1 && hlpContext.previouseSelectedSize2 == -1) || (hlpContext.previouseSelectedSize2 == size[0])  ) {
				hlpContext.selectedSizeDimension2 = index;
				hlpContext.selectedSizeDimension2Name = size[0];
			}

			return str;
		}

		if (dimCount == 2) {
			this.selectedSize = '';
			this.setEquivalentSizes(sizeInfo.intSizeCategoryId,sizeInfo.strSizeDimension2Id);
			var dimArray = this.arrayAllSizeDimension2;
			this.previouseSelectedSize2 = this.selectedSizeDimension2Name || this.objCookieData.s2;
			sizeInfo.strSizeDimension2ListOptions.split("||").invoke('split', '^,^').inject(this.selectedSize, initializeDim2Helper);

			if(dimArray.size() == 1) { this.selectedSizeDimension2 = 0; }
			if(sizeInfo.hasSizeDimension2Default) { this.selectedSizeDimension2 = sizeInfo.strDefaultSizeDimension2SizeCodeID; }
			this.activeSizeDimension2 = this.selectedSizeDimension2;
		} else { this.selectedSizeDimension2 = this.activeSizeDimension2 = -1; }
	},

	/**
	 * initialize the ajax data, starts populating the dom
	 * @param strProductId
	 * @param strVariantId
	 */
	initializeData : function(strProductId,strVariantId) {
		this.objP = objGIDPageViewAdapter.objGIDProducts.arrayProducts[strProductId];
		this.strVariantId = (strVariantId ? strVariantId : this.objP.strDefaultVariantId);
		this.objV = this.objP.arrayVariantStyles[this.strVariantId];
		this.initializeCoreComponents();
	 },

	/**
	 * prints the pirce and promo msg for each price group
	 * @param color
	 */
	getColorSwatchPriceHTML : function(color) {
		var str = [];
		if (!this.objP.isGiftCard) {
			if ( !color.strSalePrice ) {
				str.push(color.strRegularPrice);
			} else {
				str.push('<strike>' + color.strRegularPrice +'</strike> <span class="salePrice">' + color.strSalePrice + '</span>');
			}
			if (color.strPartialMupMessage != '') str.push(' <span class="quickLookMupMessage">' + color.strPartialMupMessage + '</span>');
		}
		str.push('<br class="clear"/>');
		return str.join('');
	},

	/**
	 * geneate html for the actual color swatch
	 * @param color
	 * @param index
	 */
	getColorSwatchHTML : function(color, index) {
		var hostName = location.protocol + '//' + location.host + '/';
		var NOT_APPLICABLE_IMAGE_PATH = hostName + 'Asset_Archive/pcm/assets/common/Not_Applicable.gif';
		var swatchSrc = this.objV.ProductImages.swatch[index].src;
		// For Piperlime stylecolors since 5.60 - true color swatch images are used, but for old ones use p1 thumbnail instead. 
		if(this.brandCode == '4' && swatchSrc == NOT_APPLICABLE_IMAGE_PATH) {
			swatchSrc = color.arrayVariantStyleColorImages["MainThumb"].strImagePath; // show P1 thumbnail as swatch
			this.objV.ProductImages.swatch[index].src = swatchSrc; // so productImages.do would use it in larger views popup
		}
		return this.templates.COLOR_SWATCH.evaluate( {
			index : index,
			id : this.id||'',
			label: this.strColorLabel + ' '+ resourceBundleValues.product.productColor,
			swatchSize : brandConst.INTCOLORSWATCHWIDTH[this.brandCode],
			swatchSize2 : brandConst.INTCOLORSWATCHWIDTH[this.brandCode] + 2,
			path : swatchSrc,
			altText :  color.strColorName + ' '+ resourceBundleValues.product.productImage,
			app : this.type
		} );
	},

	/**
	 * generates color swatch html
	 * @see getColorSwatches Helper
	 */
	getColorSwatches : function() {
		this.objV.arrayVariantStyleColors.oldColor = this.objV.arrayVariantStyleColors[0];
		var swatchHTML = [];
		var hlpContext = this;
		/**
		 * generate the pricing info as well as the color swatch html
		 * @param array
		 * @param color
		 * @param index
		 * @see getColorSwatchHTML
		 * @see getColorSwatchPriceHTML
		 */
		function getColorSwatchesHelper(array, color, index) {
			var oldColor = hlpContext.objV.arrayVariantStyleColors.oldColor;
			if( color.price != oldColor.price ) {
				if( index != 0 ) { array.push(hlpContext.templates.MUP_SEPERATOR) ; }
				array.push(hlpContext.getColorSwatchPriceHTML(color));
			}
			array.push(hlpContext.getColorSwatchHTML(color, index));
			hlpContext.objV.arrayVariantStyleColors.oldColor = color;
			return array;
		}
		swatchHTML.push(this.getColorSwatchPriceHTML(this.objV.arrayVariantStyleColors.oldColor));
		this.objV.arrayVariantStyleColors.inject(swatchHTML, getColorSwatchesHelper);
		swatchHTML.push(this.templates.DIV_CLEAR);
		return swatchHTML.join('');
	},

	/**
	 * generates html for size selection btns
	 * @param size
	 * @param index
	 * @param type
	 */
	getSizeSwatchHTML : function(size, index, type) {
		var label = type==1 ? this.strSizeDim1Label + ' size ': this.strSizeDim2Label + ' inseam ';
		return this.templates.DIM_SWATCH.evaluate({
			index : index,
			id : this.id||'',
			type : type,
			label:  label,
			size: size.strName.replace('(', '<br/>('),
			app : this.type
		});
	},

	/**
	 * master method for size btn html generation
	 * @param type
	 */
	getSizeDimensionSwatches : function(type) {
		var sizeDim = type == 1 ? this.arrayAllSizeDimension1 : this.arrayAllSizeDimension2, swatchHTML = [];
		var hlpContext = this;
		/**
		 * helper functions for size btn html geneation
		 * @param array
		 * @param color
		 * @param index
		 * @see getSizeSwatchHTML
		 */
		function getDimesionSwatchesHelper(array, color, index) {
			array.push(hlpContext.getSizeSwatchHTML(color, index, hlpContext.setSizeDimension));
			return array;
		}
		this.setSizeDimension = type;
		sizeDim.inject(swatchHTML, getDimesionSwatchesHelper);
		swatchHTML.push(this.templates.DIV_CLEAR);
		return swatchHTML.join('');
	},

	/**
	 * prints the html for the sold out msg when an unavalible color/size combo selected
	 */
	getSoldOutBanner : function() {
		var objSid = this.objV.arrayVariantStyleColors[this.activeColor];
		var strVariant = this.objV.strVariantName;
		var strHTMLTop = 		'<div class="top clearfix outer"><div class="topLeft"></div><div class="topCenter inner"></div><div class="topRight"></div></div>' +
												'<div id="productSoldOutMsgCenter" class="inner">';
		var strHTMLBottom = '</div>' +
												'<div class="bottom clearfix outer"><div class="bottomLeft"></div><div class="bottomCenter inner"></div><div class="bottomRight"></div></div>';



		var str = strHTMLTop + objSid.strColorName;
		if (this.objV.objStyleSizeInfo.intSizeDimensionsCount >= 1) {
			str += ' ' + this.strOutOfStockMessageWithSizes + ' ' + this.arrayAllSizeDimension1[this.activeSizeDimension1].strName;
			if (this.objV.objStyleSizeInfo.intSizeDimensionsCount == 2) {
				str += ' ' + this.arrayAllSizeDimension2[this.activeSizeDimension2].strName;
			}
			if (this.strRegularVariant != strVariant.toLowerCase()) str += " " + strVariant;
		} else {
			str += ' ' + this.strOutOfStockMessageWithoutSizes;
		}
		str += strHTMLBottom;
		return str;
	},

	/**
	 * gets price text html
	 * @param strPrice
	 * @param strSalePrice
	 */
	getPriceText : function(strPrice,strSalePrice) {
		return (strSalePrice == '' ? strPrice : '<strike>' + strPrice + '</strike><span class="salePrice">' + strSalePrice + '</span>');
	},

	/**
	 * prints html for user selection on top of the add to bag btn
	 * @param color
	 * @param size1
	 * @param size2
	 * @param variant
	 */
	getSelectionConfirmText : function(color,size1,size2,variant) {
		return color + (size1 != '' ? ', ' + size1 : '')
			+ (size2 != '' ? ' ' + size2 : '')
			+ (variant.toLowerCase() != this.strRegularVariant ? ' ' + variant : '');
	},

	/**
	 * checks if a valid color/size combo is selected when add to bag is clicked
	 * @param isAvailable
	 * @param isDisabled
	 */
	getAddtoBag : function(isAvailable, isDisabled) {
		var dimCount = this.objV.objStyleSizeInfo.intSizeDimensionsCount;
		var isBtnOn = this.selectedSizeDimension1 != -1 && !isDisabled && isAvailable &&
		   ((this.selectedSizeDimension2 != -1 && dimCount == 2)^dimCount == 1);
        
        var classes = this.type == 'shoppingBagPage' ? 'universalButtonSprite universalButtonSpriteUpdateItem' : 'quicklook-sprites sprite-button_add_to_bag_';
        var btnO = this.type == 'shoppingBagPage' ? 'O' : 'o';
		this.objAddtoBag.setAttribute('isDisabled',!isBtnOn);
		this.objAddtoBag.className = isBtnOn ? classes + btnO + 'n' : isAvailable ? classes + btnO + 'ff' : classes + btnO + 'ut';
		this.objAddtoBag.alt = isBtnOn ? this.strAddToBagAltTextActive : isAvailable ? this.strAddToBagAltText : this.strAddToBagAltTextOut;
		this.objAddtoBag.onclick = isBtnOn ? this.addToBag.bind(this) : this.checkErrors.bind(this);
	},

	/**
	 * builds the 'fabric & care' bullet html in the following order:
	 * 1 Percent/Content
	 * 2 Fabric Copy Bullets
	 * 3 Fabric Copy Links
	 * 4 Flammability Warning
	 * 5 Care Instruction Text
	 * 6 Country of Origin
	 * @param careCopy - preformatted default Fabric Copy Bullets and Fabric Copy Links
	 */
	getFabricCare : function(careCopy) {
        var isPiperlime = brandConst.BRAND_ID == "PL", isAthleta = brandConst.BRAND_ID == 'AT';
		var careText = [], percentContent = [],
			bullet = this.templates.BULLET, percent = this.templates.PERCENT,
			contentSize = this.objP.arrayFabricContent.size();

		if (contentSize > 0) {
			this.objP.arrayFabricContent.inject(percentContent,
					function(str, content, index) {
						str.push(percent.evaluate(
							{ percent : parseInt(content.strPercent), name : content.strName, divider : index < contentSize - 1 ? ', ' : '. ' }));
						return str;
					});
			careText.push(bullet.evaluate({content: percentContent.join('')}));
		}
        if (careCopy != '') {
        	// careText is passed in pre-formatted. Just push it onto the end of the string as-is.
        	careText.push(careCopy);
        }
        if (this.objP.strFlammableWarningText != "") {
			careText.push(bullet.evaluate({content:this.objP.strFlammableWarningText}));
		}
		if (this.objP.strCareInstructionText != "") {
			careText.push(bullet.evaluate({content : this.objP.strCareInstructionText}));
		}
        if(!(isPiperlime || isAthleta) ) { careText.push(bullet.evaluate({content : this.getProductOrigin()})); }

		return careText.join('');
	},

	/**
	 * prints the content for each tab in quicklook
	 * @param tab
	 */
	getTabContent : function(tab) {
		var bullet = this.templates.BULLET, content = [];
		var infoBlocks = tab.arrayInfoTabInfoBlocks;
		var hlpContext = this;

		function getTabContentHelper(array, block) {
			if(block.hasLink) {
				if (!window['objO']) { // no links in outfit
					if (block.isSizeChart) {
						array.push(bullet.evaluate({content:'<a href="javascript:' + hlpContext.type + '.openSizeChart()' + block.strDisplayText + '</a>'}));
					} else {
						block.strLink = (block.isExternal ? block.strExternalLink : block.strTemplateAction + ".do?cid="+block.intBusinessId);
						if (block.isPopUp) {
							array.push(bullet.evaluate({content:'<a href="javascript:' + hlpContext.type + '.openInfoPopUp(\'' + block.strLink + '\','+block.intPopUpWidth+','+block.intPopUpHeight+');">' + block.strDisplayText + '</a>'}));
						} else {
							array.push(bullet.evaluate({content:'<a href="'+block.strLink+'" ' + (block.isExternal ? 'target="_top"' : '') + '>' + block.strDisplayText + '</a>'}));
						}
					}
				}
			} else {
				array.push(bullet.evaluate({content:block.strDisplayText}));
			}
			return array;
		}

		if( infoBlocks ) {
			infoBlocks.inject(content, getTabContentHelper);
		}
		return content.join('');
	},

	/**
	 * prints size 1 html when user selectes size 1 btn
	 * @param strName
	 */
	getSizeDimension1Text : function(strName) {
		return this.templates.SIZE_LABEL_TEXT.evaluate({label:this.strSizeDim1Label, dispName:this.objV.objStyleSizeInfo.strSizeDimension1Name, name: strName});
	},

	/**
	 * prints size 2 html
	 * @param strName
	 */
	getSizeDimension2Text : function(strName) {
		return this.templates.SIZE_LABEL_TEXT.evaluate({label:this.strSizeDim2Label, dispName:this.objV.objStyleSizeInfo.strSizeDimension2Name, name: strName});
	},

	/**
	 * parse err msg from add to bag ajax and display err msg accordingly
	 *
	 */
	getBagError : function() {
		var errorArray = [], strSelection = "", vowelExp = /^[aeiou]/i;

		if (this.isColorError) {
			errorArray.push(this.objP.strStyleColorDisplayName);
		}
		if (this.isSizeDimension1Error) {
			errorArray.push(this.objV.objStyleSizeInfo.strSizeDimension1Name);
		}
		if (this.isSizeDimension2Error) {
			errorArray.push(this.objV.objStyleSizeInfo.strSizeDimension2Name);
		}
		if (errorArray.length == 1) {
			strSelection = errorArray[0];
		} else if (errorArray.length == 2) {
			strSelection = errorArray[0] + " & " + errorArray[1];
		} else {
			strSelection = errorArray[0] + ", " + errorArray[1] + " & " + errorArray[2];
		}
		var strMsg = (strSelection.search(vowelExp) == -1 ? this.strBagErrorPrefix : this.strBagErrorPrefix2) + ' ' + strSelection + ' ' + this.strBagErrorSuffix;

		return this.templates.BAG_ERROR.evaluate({msg: strMsg});
	},

	/**
	 * returns html for user selected color
	 * @param strName
	 */
	getTextColor : function(strName) {
		return this.templates.TEXT_COLOR.evaluate({label: this.strColorLabel , colorLabel:this.objP.strStyleColorDisplayName, name: strName});
	},

	/**
	 * initialize omniture obj
	 *
	 * Modified 1/29/2008 Byung Kim -- added productBrandCode & productBrandAbbr
	 */
	initializeOmni : function() {
		this.reporting.setProductBrandInfo(this.objP.brandCode);
        /**
 		* Modified:  Keo 07/28/08 - Added wrapper for G to H
 		*/
		if(!(reportingService||{}).isActive){
			if (omni && omni[this.omniView]) {
				omni.strProductColorName = this.objV.arrayVariantStyleColors[this.selectedColor].strColorName;
	            omni.strProductStyleColorId = this.objV.arrayVariantStyleColors[this.selectedColor].strColorCodeId;
	            omni[this.omniView](this.objP.strProductId,this.objP.strProductStyleName);
			}
		}
	},

	setReportingService : function (viewType, app) {
		if(!(reportingService||{}).isActive) return;
		var commonModel = reportingService.controller.viewManagers.commonViewManager.model;
		var productBrandCode = this.objP.brandCode;
		var brandSite = gidLib.reporting.getBrandSite(productBrandCode);
		commonModel.commonProductBrandCode = productBrandCode;
		commonModel.commonProductBrandAbbr = (brandSite ? brandSite.brandAbbr : "");
		reportingService.controller.viewManagers[(viewType||this.type.toLowerCase()) + 'ViewManager'].controller.getReportRequest(app);
	},

	/**
	 * action taken when the product image is clicked on quickLook
	 */
	goProductPage : function() {
		var strCookieVal =	this.objV.arrayVariantStyleColors[this.selectedColor].strColorName + "," +
							(this.arrayAllSizeDimension1[this.selectedSizeDimension1] ? this.arrayAllSizeDimension1[this.selectedSizeDimension1].strName : "") + "," +
							(this.arrayAllSizeDimension2[this.selectedSizeDimension2] ? this.arrayAllSizeDimension2[this.selectedSizeDimension2].strName : "") + "," +
							this.strSelectedQty;
		setCookieVar("globalSession","selectionData",strCookieVal)
        var strURL = (brandConst.CATALOG_2_ACTIVE == 'true' ? '/browse/' + brandConst.PRODUCT_2_ACTION + '?catalog2Active=true&cid=' : '/browse/product.do?cid=') + getQuerystringParam("cid") + '&pid=' + this.objP.strProductId;
		strURL += "&vid=" + this.objV.strVariantId;
		if (this.isFromSBS) strURL += this.strSBSUrlSuffix;
		window.location.href = strURL;
	},

	getOnOrderWindow : function(strDate) { return  this.strOnOrderMessage + " " + strDate; },
	getLowInventoryWindow : function() { return this.strLowInventoryMessage; },
	getMarketingFlag : function(obj) { return obj.isImageType ? '' : this.templates.MARKETING_FLAG.evaluate({name: obj.strMarketingFlagName}); },
	getProductOrigin : function() { return this.objP.isImported ? this.strIsImported : this.strIsNotImported; },


	/**
	 * reporting is a subclass of GID.Browse.Base that deals with reporting functionality
	 * @base GID.Browse.Base
	 */
	reporting : {

		/**
		 * setProductBrandInfo sets the omni.productBrandCode & omni.productBrandAbbr vars using the provided brandCode & gidBrandSiteConstruct
		 * @author Byung Kim
		 * @date 1/30/2008
		 */
		setProductBrandInfo:function(brandCode) {
			if (window["omni"] && brandCode) {
				var brandSite = gidLib.reporting.getBrandSite(brandCode);
				omni.productBrandCode = brandCode;
				omni.productBrandAbbr = (brandSite ? brandSite.brandAbbr : "");
			}
		}
	}

};
Object.extend(GID.Browse.Base, brandProperties||{});

/**
* QuickLook - Constructor for object handling in the QuickLook Feature
* @constructor
* @author Yoshi Chen
* @date 12/04/2007
*/
var quickLook = Object.extend(window['quickLook']||{},  GID.Browse.Base);
Object.extend(quickLook, {
	arrayAllSizeDimension1: [],
	arrayAllSizeDimension2: [],
	id : '_ql',
	templates : Object.extend(gidLib.clone(GID.Browse.Base.templates), {

		QL_SWATCH_CONTENT : new Template( '#{colorSwatches}#{size1Swatches}#{size2Swatches}#{variants}'),

		COLOR_SWATCH_TEMP : new Template(
					'<div id="quickLookColorText" class="quickLookSelectionLabel"></div>' +
					'<div id="quickLookMarketingFlagColor"></div>' +
					'<div id="quickLookColorSwatches">#{colorSwatches}</div>'),

		SIZE_DIM1_TEMP : new Template(
				 '<div id="quickLookSize1Text" class="quickLookSelectionLabel"></div>' +
				'<div id="quickLookMarketingFlagSize"></div>' +
				'<div id="quickLookSize1Swatches">#{size1Swatches}</div>'),

		SIZE_DIM2_TEMP : new Template(
				'<div id="quickLookSize2Text" class="quickLookSelectionLabel"></div>' +
				'<div id="quickLookMarketingFlagColor"></div>' +
				'<div id="quickLookSize2Swatches">#{size2Swatches}</div>'),

		VARIANTS_TEMP : new Template('<div id="quickLookVariants">#{variants}</div>'),


		QL_SIZE_CHART : new Template('<div class="clearfix">' +
            '<div id="quickLookSizeChart" class="quickLookSizeChart"><a href="javascript:quickLook.openSizeChart();"><img src="/assets/common/clear.gif" class="quicklook-sprites sprite-sizeChart" border="0" alt="#{sizeChart}"/></a></div>' +
        '</div>'),

		QUICK_LOOK : new Template(
        '<div id="quickLookWindowTop" class="quickLookWindowTop cursorMove"></div>' +
		'<div id="quickLookWindowContent" class="quickLookWindowContent clearfix">' +
			'<div id="quickLookPageError" class="quickLookPageError pageError"></div>' +
			'<div id="quickLookContentLeft" class="quickLookContentLeft clearfix">' +
				'<div id="quickLookProductImage" class="quickLookProductImage"><a href="javascript:quickLook.goProductPage();"><img src="#{mainImg}" name="quicklook_product_image" id="quicklook_product_image"/><img src="#{mainImg}" name="quicklook_outfit_image" id="quicklook_outfit_image" style="display: none; "/></a></div>' +
				'<div id="quickLookProductImageTools" class="quickLookProductImageTools">#{imgTools}</div>' +
				'<div id="imageThumbs#{id}"></div>' +
				'<div id="quickLookVendorName" class="quickLookVendorName">#{vendorName}</div>' +
				'<div id="quickLookProductName" class="quickLookProductName"><a href="javascript:quickLook.goProductPage();">#{productName}</a></div>' +
				'<div id="quickLookProductOriginCopy" class="quickLookProductOriginCopy"></div>' +
				'<div id="quickLookMarketingFlagStyle" class="quickLookMarketingFlagStyle"></div>' +
				'<div id="quickLookMarketingCallOut" class="quickLookMarketingCallOut"></div>' +
			'</div>' +
			'<div id="quickLookContentRight" class="quickLookContentRight">' +
				'<div id="quickLookInfoTabs" class="quickLookInfoTabs clearfix">' +
					'<img onclick="quickLook.setTab(0);" onMouseOver="quickLook.tabOver(0);" onMouseOut="quickLook.tabOut(0);" src="/assets/common/clear.gif" alt="" name="tab0" id="tab0" class="quicklook-sprites sprite-tab_size_on" />' +
					'<img onclick="quickLook.setTab(1);" onMouseOver="quickLook.tabOver(1);" onMouseOut="quickLook.tabOut(1);" src="/assets/common/clear.gif" class="quicklook-sprites sprite-tab_overview_off" alt="" name="tab1" id="tab1" />' +
					'<img src="/assets/common/clear.gif" class="quicklook-sprites sprite-quickLook_close" alt="#{closeText}" id="quickLookClose" onclick="quickLook.closeQuickLook();"/>' +
				'</div>' +
				'<div id="quickLookSwatches" class="quickLookSwatches">' +
					'<div id="quickLookGIDPromoMessage" class="quickLookGIDPromoMessage"></div>' +
					'<div id="quickLookMupMessageStyle" class="quickLookMupMessageStyle quickLookMupMessage"></div>' +
					'#{swatches}<div id="quickLookQtyArea" class="quickLookQtyArea clearfix">' +
						'<div id="quickLookQtyLabel" class="quickLookQtyLabel"><label for="quickLookQty">#{qtyLabel}</label></div>' +
						'<div id="quickLookQtyForm" class="quickLookQtyForm"><select id="quickLookQty" name="quickLookQty" onChange="quickLook.setSelectedQty()"></select></div>' +
					'</div>' +
					'#{giftCard}' +
				'</div>' +
				'<div id="quickLookTabArea" class="quickLookTabArea quickLookTabContent"></div>#{confirmation}' +
				'<div id="quickLookConfirmationAreaBottom" class="quickLookConfirmationAreaBottom"></div>' +
				'<div id="productMailOnlyReturn2"><img src="/assets/common/clear.gif" class="quicklook-sprites sprite-mailonly" alt="Return by mail only"/></div>' +
				'<div id="productFreeReturn2"><img src="/assets/common/clear.gif" class="quicklook-sprites sprite-freereturn" alt="Free returns"/></div>' +
				'<div id="productNonreturnable2"><img src="/assets/common/clear.gif" class="quicklook-sprites sprite-nonreturnable" alt="Nonreturnable"/></div>' +
			'</div>' +
		'</div>' +
		'<div id="quickLookWindowBottom" class="quickLookWindowBottom"></div>' +
		'<div id="quickLookInventoryStatusWindow" class="quickLookInventoryStatusWindow"></div>'),

		CONFIRM_AREA : new Template(
			'<div id="quickLookConfirmationArea" class="quickLookConfirmationArea clearfix">' +
				'<div id="quickLookConfirmText" class="quickLookConfirmText"></div>' +
				'<div id="quickLookPriceText" class="quickLookPriceText price"></div>' +
				'<label for="addToBagBtn" class="cssHide2">Select color and size before adding to bag</label>' +
				'<input type="image" isDisabled="true" id="quickLookAddtoBag" onclick="quickLook.checkErrors();" src="/assets/common/clear.gif" class="quicklook-sprites sprite-button_add_to_bag_off"/>' +
			'</div>')
	}),

	QuickLookDivObjMap : {
		objStyleMupMessage : 'quickLookMupMessageStyle',
		objGIDPromoMessage : 'quickLookGIDPromoMessage',
		objStyleColorMarketingFlag : 'quickLookMarketingFlagColor',
		objSkuMarketingFlag : 'quickLookMarketingFlagSize',
		objStyleMarketingFlag : 'quickLookMarketingFlagStyle',
		objStyleMarketingCallOut : 'quickLookMarketingCallOut',
		objSoldOutMsg : "productSoldOutMsg",
	   objColorErrorMsg : "productColorError",
	   objSizeDimension1ErrorMsg : "productSizeDimension1Error",
	   objSizeDimension2ErrorMsg : "productSizeDimension2Error",
	   objBagErrorMsg : "productBagError",
		objTextSizeDimension1 : 'quickLookSize1Text',
		objTextSizeDimension2 : 'quickLookSize2Text',
		objTextColor : 'quickLookColorText',
		objPriceText : 'quickLookPriceText',
		objAddtoBag : 'quickLookAddtoBag',
		objSelectedConfirmText : 'quickLookConfirmText',
		objInventoryStatusWindow : 'quickLookInventoryStatusWindow',
		objTabArea : 'quickLookTabArea',
		objQtyDropDown : 'quickLookQty',
		size1Swatches : 'quickLookSize1Swatches',
		size2Swatches : 'quickLookSize2Swatches',
		colorSwatches : 'quickLookColorSwatches',
		objProductOriginCopy : 'quickLookProductOriginCopy',
		objInlineBagError : 'quickLookPageError',
		p1Image : 'quicklook_product_image',
        p1ImageHolder: 'quickLookProductImage',
        p1OutfitImage: 'quicklook_outfit_image'
	 },

	baseInitializeData : GID.Browse.Base.initializeData,
	baseInitializeVariant : GID.Browse.Base.initializeVariant,

	strDefaultCategoryId : getQuerystringParam('cid'),
	type: 'quickLook',
	p1type : 'quickLook',
	omniView : 'setQuickLookView',
	/**
	 * overites GID.Browse.Base variant method, calls original method 1st
	 * @param strProductId
	 * @param strVariantId
	 */
	initializeVariant : function(strProductId,strVariantId) {
		this.baseInitializeVariant(strProductId,strVariantId);
		this.loadQuickLook();
		this.setVariantToReportingService(strVariantId);
	},
	/**
	 * opens quicklook, checks if ajax data is cached, if not fetch data using ajax
	 * @param strTarget
	 */
	launchQuickLook : function(strTarget) {
        this.logTeaLeafEvent(this.objQuickLookTarget.obj,'mouseover');
        this.logTeaLeafEvent(this.objQuickLookLauncher,'click');
        TeaLeaf.Client.tlProcessNode('quickLookWindow');

		var strProductId = this.objQuickLookTarget.strProductId, isCrossSell = this.objQuickLookTarget.isCrossSell;
		var strStyleColorId = (this.objQuickLookTarget.strDefaultStyleColor != -1 ? this.objQuickLookTarget.strDefaultStyleColor : undefined);

        if (strTarget && strTarget.getDimensions) {
			this.objQuickLookTarget.position = returnObjPosition(strTarget);
			this.objQuickLookTarget.obj = $(strTarget);
        }

		if (!objInlineBag.isOpen) {
			if (!this.isQuickLookOpen || brandConst.QUICKLOOK_ALLOW_MULTIPLE) {
                this.brandCode = this.objQuickLookTarget.brandCode;
                this.brandSite = gidBrandSiteConstruct.gidBrandSites[this.brandCode];
                this.resources.BTN_PATH = this.brandSite.unsecureUrl + brandConst.resources.BTN_PATH;
                this.resources.ASSET_PATH = this.brandSite.unsecureUrl + brandConst.resources.ASSET_PATH;
                var product = objGIDPageViewAdapter.objGIDProducts.arrayProducts[strProductId];
				if (product) {
					this.closeQuickLookLauncher();
					this.dataLoaderAction = "auto";
					this.isQuickLookOpen = true;
					this.initializeData(strProductId);
                    this.setupQuickLookBoundBox();
					this.loadQuickLookAnimate();
					if(isCrossSell) { this.goCrossSell(strProductId);}
					if(!(window['reportingService']||{}).isActive) {
						this.initializeOmni();
					}
					else {
						this.setReportingService();
					}
					this.reopenQuickLook = false;
				} else {
					if (!this.isFromSBS) {
						var variantId = this.strDefaultStyleVariant;
						if (this.objQuickLookTarget.strVariantId && this.objQuickLookTarget.strVariantId != "-1") {
							variantId = this.objQuickLookTarget.strVariantId;
						}
						this.loadProductData(strProductId,"auto",variantId,strStyleColorId, this.brandCode);
					} else {
						this.loadProductData(strProductId,"auto",undefined,strStyleColorId, this.brandCode);
					}
				}
			} else {
				this.reopenQuickLook = true;
				this.closeQuickLook();
			}
		} else {
			setTimeout('quickLook.launchQuickLook()', 250);
		}
	},

	/**
	 * overwrites base intializedata
	 * @param strProductId
	 * @param strVariantId
	 */
	initializeData : function(strProductId,strVariantId) {
		this.baseInitializeData(strProductId,strVariantId);
		this.initializeTabs();
		this.productThumbs = new ProductThumbs(this);
	},

	/**
	 * finds the overview tab index for quicklook
	 * @param tab
	 */
	findOverviewTab : function(tab) {
		this.objP.arrayInfoTabs.overviewIndex++;
		return tab.strInfoTabId == this.OVERVIEWTABID;
	},

	/**
	 * initialize tabs for quicklook
	 */
	initializeTabs : function() {
		this.objP.arrayInfoTabs.overviewIndex = -1;
		this.objP.arrayInfoTabs.find(this.findOverviewTab.bind(this));
		this.intTabOverviewIndex = this.objP.arrayInfoTabs.overviewIndex;
	},

	/**
	 * defines a bound box base on browser dimension and scroll length, so quicklook always opens
	 * within the window
	 */
	setupQuickLookBoundBox : function() {
		if(!document.body) return;
		this.minX = window.pageXOffset || document.documentElement.scrollLeft;
		this.minY = window.pageYOffset || document.documentElement.scrollTop;
		this.browserW = window.innerWidth || document.documentElement.clientWidth;
		this.browserH = window.innerHeight || document.documentElement.clientHeight;
		this.maxX = this.browserW + this.minX;
		this.maxY = this.browserH + this.minY;
	},

	/**
	 * opens quicklook with scriptaculous fade effect
	 */
	loadQuickLookAnimate : function() {
		this.loadQuickLook();
		this.objQuickLook.addClassName('brand' + brandConst.BRAND_CODE);
		this.quickLookHeight = this.objQuickLook.offsetHeight;
		this.quickLookWidth = this.objQuickLook.offsetWidth;
		this.quickLookX = this.objQuickLookTarget.position[0] - this.objQuickLook.offsetWidth * 0.5;
		this.quickLookY = this.objQuickLookTarget.position[1] - this.objQuickLook.offsetHeight * 0.5;

		 var x = this.quickLookX < this.minX ? this.minX + 50 : this.quickLookX > this.maxX - this.quickLookWidth ? this.maxX - this.quickLookWidth - 50 : this.quickLookX;
		var y = this.quickLookY < this.minY ? this.minY + 50 : this.quickLookY > this.maxY - this.quickLookHeight? this.maxY - this.quickLookHeight - 50 : this.quickLookY;

		this.objQuickLook.style.display = 'none';
		setObjPosition(this.objQuickLook, x, y);

        new Effect.Appear(this.objQuickLook.id, {duration: 0.5,
            afterFinish:function() {
                quickLook.hiddenDropDowns = gidLib.hideDropDownsUnderElement(quickLook.objQuickLook, 'select[name!="quickLookQty"]');
            }} );
    },

	/**
	 * generates quicklook html and initialize default user states
	 */
	loadQuickLook : function() {
        this.objQuickLook.innerHTML = this.getQuickLookFrame(this.id);
		this.productThumbs.generateThumbs();

		if(this.enableDrag) {
			this.objP.draggable = new Draggable(this.objQuickLook.id, {handle:'quickLookWindowTop',
                onStart: function() { gidLib.showDropDowns(quickLook.hiddenDropDowns); },
                onEnd: function() { quickLook.hiddenDropDowns = gidLib.hideDropDownsUnderElement(quickLook.objQuickLook, 'select[name!="quickLookQty"]'); }
            });
		}
		gidLib.loadDomObjMap(this, this.commonDomObjMap);
		gidLib.loadDomObjMap(this, this.QuickLookDivObjMap);
		this.setSwatchButtons();
		this.productThumbs.setLargeImage(this.productThumbs.selectedThumb);
		this.setCommonDimensionSizeWidth(1, this.size1Swatches, this.MINIMUMSIZESWATCHWIDTH);
		this.setCommonDimensionSizeWidth(2, this.size2Swatches);

		this.initializePromotions();
		this.initializeMarketingFlags();
		this.setQtyDropDown();
		this.setInfoTabArea();
		this.setProductOriginCopy();
		this.setGIDPromoMessage();

		this.setColorSwatches();
		this.setSizeDimensionSwatches(1, this.size1Swatches);
		this.setSizeDimensionSwatches(2, this.size2Swatches);
		this.updateDataLabels();
	},

	/**
	 * prints product detail html
	 */
	setInfoTabArea : function() {
		if(this.intTabOverviewIndex >= 0) {
			this.objTabArea = replaceHTML(this.objTabArea,
					this.templates.OVERVIEW_TEMP.evaluate({app: this.type, content: this.getOverViewTabHTML(), id: this.objP.strProductId, link: this.strProductDetailLink}) + 
					'<div id="quickLookProductVendorId" style="display:none;"></div>');
		}
		this.objProductVendorInfo = $('quickLookProductVendorId');
	},

	/**
	 * close quicklook with fade effect
	 */
	closeQuickLook : function() {
		/**
		 * helper method to handle quicklook after close event
		 * @see closeQuickLook
		 */
		var hlpContext = this;
		function closeQuickLookHelper() {
			with(hlpContext) {
                gidLib.showDropDowns(quickLook.hiddenDropDowns);
                clearQuickLook();
				isQuickLookOpen = false;
				closeRelatedWindows();
				if(reopenQuickLook) {
					launchQuickLook();
				}
			}
		}
		new Effect.Fade(this.objQuickLook, {
			afterFinish: closeQuickLookHelper, duration: 0.5});
	},

	/**
	 * resets quicklook div position, and clear user states
	 */
	clearQuickLook : function() {
		this.clearErrors();
        this.objQuickLook.removeClassName('brand' + this.brandCode);
        this.resources.ASSET_PATH = brandConst.resources.ASSET_PATH;
        this.resources.BTN_PATH = brandConst.resources.BTN_PATH;
		this.objQuickLook.setStyle({top: '-5000px', left: '0px', display:'block'});
		this.objSoldOutMsg.style.visibility = "hidden";
		if (objInlineBag && (!objInlineBag.isOpen && !objInlineBag.doOpenBag)) gidLib.showDropDowns(this.hiddenDropDowns);
		this.objSoldOutMsg.update();
		this.activeColor = -1;
		this.activeSizeDimension1 = -1;
		this.activeSizeDimension2 = -1;
		this.selectedColor = -1;
		this.selectedSizeDimension1 = -1;
		this.selectedSizeDimension2 = -1;
		this.selectedColorName = "";
		this.selectedSizeDimension1Name = "";
		this.selectedSizeDimension2Name = "";
		this.intTab = 0;
		this.arrayAllSizeDimension1 = [];
		this.arrayAllSizeDimension2 = [];
		this.strSelectedQty = 1;
		this.dataLoaderAction = "";
	},

	/**
	 * methods to handle quicklook tab mouse over/out events
	 * @param n
	 */
	tabOver : function(n) {
		if (n != this.intTab) {
            $('tab' + n).className = 'quicklook-sprites sprite-' + quickLook.arrayTabImages[n]['objOver'];
		}
	},

	tabOut : function(n) {
		if (n != this.intTab) {
            $('tab' + n).className = 'quicklook-sprites sprite-' + quickLook.arrayTabImages[n]['objOff'];
		}
	},

	setTab : function(n) {
		if (n != this.intTab) {
            $('tab' + this.intTab).className = 'quicklook-sprites sprite-' + quickLook.arrayTabImages[this.intTab]['objOff'];
            $('tab' + n).className = 'quicklook-sprites sprite-' + quickLook.arrayTabImages[n]['objOn'];
			this.clearErrors();
			this.setTabContent(n);
			this.intTab = n;
		}
	},

	setTabContent : function(n) {
		if (n == 0) {
			this.objTabArea.style.display = "none";
			$("quickLookSwatches").style.display = "block";
		} else {
			var intH = $("quickLookSwatches").offsetHeight;
			this.objTabArea.style.height = (intH + this.TABCONTENTOFFSET) + "px";
			this.objTabArea.style.display = "block";
			$("quickLookSwatches").style.display = "none";
		}
	},

	postLoadData : function() {
		var objC = objGIDPageViewAdapter.objGIDCategory;
		if (this.intDataLoadCounter < objC.arrayProducts.length) {
			var strProductId = objC.arrayProducts[this.intDataLoadCounter].strCatalogItemID;
			if (objGIDPageViewAdapter.objGIDProducts.arrayProducts[strProductId] == null)  {
				this.loadProductData(strProductId);
			} else {
				this.loadNextProduct();
			}
		}
	},

	/**
	 * generates swatch html for quicklook
	 */
	getQuickLookSwatchContent : function() {
		return this.templates.QL_SWATCH_CONTENT.evaluate({
			colorSwatches : this.templates.COLOR_SWATCH_TEMP.evaluate({colorSwatches:this.getColorSwatches()}),
			size1Swatches : (this.objV.objStyleSizeInfo.intSizeDimensionsCount >=1 ? this.templates.SIZE_DIM1_TEMP.evaluate({size1Swatches:this.getSizeDimensionSwatches(1)}) : ''),
			size2Swatches : (this.objV.objStyleSizeInfo.intSizeDimensionsCount == 2 ? this.templates.SIZE_DIM2_TEMP.evaluate({size2Swatches: this.getSizeDimensionSwatches(2)}) : ''),
			variants : (this.objP.hasSplitVariants || this.objP.hasMergeVariants ? this.templates.VARIANTS_TEMP.evaluate({variants:this.getVariants()}) : '')
		});
	},

    arrayTabImages: [{
            objOff: "tab_size_off",
            objOver:"tab_size_on",
            objOn: "tab_size_over"
        },
        {
            objOff : "tab_overview_off",
            objOn : "tab_overview_on",
            objOver : "tab_overview_over"
    }],

	/**
	 * generates html for quicklook
	 * @param id
	 */
	getQuickLookFrame : function(id) {
        return this.templates.QUICK_LOOK.evaluate({
			swatches : this.getQuickLookSwatchContent(),
			imgTools : (this.objV.arrayVariantStyleColors[0].hasLargerImage || this.objP.hasAlternateImage) ?
			 this.templates.MORE_VIEWS.evaluate({btnPath: this.resources.BTN_PATH, app: this.type}): '',
            brandName: 'brand' + this.brandCode,
			id : id||this.id,
			mainImg : this.objV.ProductImages.quickLook[this.activeColor].src,
			width : this.QUICKLOOKIMGWIDTH,
			height : this.QUICKLOOKIMGHEIGHT,
			productName : this.objP.strProductStyleName,
			vendorName : this.objP.strVendorName,
			assetPath : this.resources.ASSET_PATH,
            qtyLabel : this.strQuantityLabel,
			giftCard :  !this.objP.isGiftCard && (this.objP.sizeChartId||'') != '' ? this.templates.QL_SIZE_CHART.evaluate({sizeChart:resourceBundleValues.product.sizeChart}): '',
			confirmation : this.templates.CONFIRM_AREA.evaluate({id:this.id}),
			closeText : resourceBundleValues.product.closeQuicklook
		});
	},

	/**
	 * print avalible variants as links
	 */
	getVariants : function() {
		var str = ['<p>' + this.strOtherVariants + ' '];
		var hlpContext = this;

		function getVariantHelper(array, variant) {
			if(variant && variant != hlpContext.objV) {
				array.push(hlpContext.templates.VARIANT.evaluate({
							catalogItemId : variant.strCatalogItemId,
							variantId : variant.strVariantId,
							name : variant.strVariantName.toLowerCase(),
							app : hlpContext.type
						}));
			}
			return array;
		}
		Object.values(this.objP.arrayVariantStyles).inject(str, getVariantHelper);
		str.push('</p><p class="legal">(' + this.strVariantLegalCopy + ')</p>');
		return str.join('');
	}
});

/**
 * ProductImages contains img objects for the current variant
 * @constructor
 * @author yoshi
 */
var ProductImages = Class.create();
ProductImages.prototype = {
	templates : {
		ALT_TEXT_THUMB : resourceBundleValues.product.additionalView+' '
	},

	initialize : function() {
		this.swatch = []; this.main = []; this.large = []; this.thumb = []; this.quickLook = [];
	},

	imgPath : brandConst.imagePath,
	imgThumbPath : brandConst.imageThumbPath,
	dummyImgPath : '/assets/common/clear.gif',
/**
 * loads images such as alt view and outfit
 * @param obj
 * @param alt
 * @author yoshi
 */
	loadOtherImages : function(obj, alt) {
		var imgPath = alt.strImagePath || ProductImages.prototype.dummyImgPath;
		var imgThumbPath = alt.strThumbImagePath || ProductImages.prototype.dummyImgPath;

		var img = new Image(), imgThumb = new Image();
		img.src = imgPath; imgThumb.src = imgThumbPath;
		img.name = imgThumb.name = alt.strColorName;
		img.altText = alt.strColorName + ' product image';
		img.type = imgThumb.type = 'alt';
		imgThumb.altText = obj.templates.ALT_TEXT_THUMB + (obj.thumb.length - obj.thumbCountBase);
		obj['large'].push(img); obj['main'].push(img); obj['thumb'].push(imgThumb);

		return obj;
	},

/**
 * loads only color imgs, such as p1 on BRONG
 * @param obj
 * @param color
 * @author yoshi
 */
	loadColorImages : function(obj, color) {
		function loadImages(obj, key) {
			var view = color.arrayVariantStyleColorImages[key];

			function imageLoader(arrayKey) {
					obj[arrayKey].push(Object.extend(new Image(), {
					src: ((arrayKey=='thumb' && view[obj.imgThumbPath]) ? view[obj.imgThumbPath] : view[obj.imgPath]) || ProductImages.prototype.dummyImgPath,
						name: color.strColorName,
						altText: color.strColorName + ' '+ resourceBundleValues.product.productText + ((arrayKey=='thumb') ? ' '+ resourceBundleValues.product.thumbnail : '') + ' '+resourceBundleValues.product.imageText,
						type: 'color'
					}));
				}
			obj.variantMap[key].each(imageLoader);
			return obj;
		}

		Object.keys(obj.variantMap).inject(obj, loadImages);
		return obj;
	},
	
/**
 * populates internal img array from parent, could be product page, or quicklook, etc
 * @param product
 * @param app
 * @author yoshi
 */
	init : function(product, app) {
		this.app = app;
        this.variantMap = brandConst.variantMap[this.app.brandCode];
		var objV = app.objV;
		this.thumbCountBase = objV.arrayVariantStyleColors.size() - 1;
		objV.arrayVariantStyleColors.inject(this, this.loadColorImages);
		product.objProductStyleImages.arrayAlternateViewImages.inject(this, this.loadOtherImages);
		product.objProductStyleImages.arrayWaysToWearImages.inject(this, this.loadOtherImages);
		if( product.objCrossSellInfo && product.objCrossSellInfo.isPhotoOutfit ) {
			var thumb = new Image(), large = new Image();
			thumb.src = product.objCrossSellInfo.strImageSrc; large.src = thumb.src.replace('oviv','odv');
			thumb.altText = resourceBundleValues.product.outfitView;
			thumb.type = 'outfit';
			this.thumb.push(thumb); this.main.push(large); this.large.push(large);
		}
		this.showThumbs = this.getThumbSize() > objV.arrayVariantStyleColors.size();
	},

    getThumbSize: function() {
        return this.thumb.pluck('src').inject(0, function(num, str) { return num + (str.indexOf('clear.gif') == -1 ? 1:0); });
    },

    clear : function() { this.quickLook.length = 0; this.thumb.length = 0; this.large.length = 0; this.main.length = 0; this.swatch.length = 0; }
 };

/**
 * ProductThumbs Class - contains functions related to alt view images and nanos
 * @constructor
 * @author yoshi
 */
var ProductThumbs = Class.create();
ProductThumbs.prototype = {
	// html template for thumbnails
	THUMBSTAG : new Template( '<img class="#{className}" onclick="#{app}.productThumbs.setLargeImage(this, true);" onmouseover="#{app}.productThumbs.chgPreviewImg(this, \'over\');" onmouseout="#{app}.productThumbs.chgPreviewImg(this, \'out\');" index="#{index}" alt="#{altText}" id="thumbImage#{index}#{id}" src="#{src}"/>'),

	initialize : function(app) {
		this.viewLength = brandConst.perspViewLength[app.brandCode];
		this.app = app;
		this.productClassTypId = this.app.objP? this.app.objP.productClassTypId : 0;
		this.objV = this.app.objV;
		this.zoom = this.app.ProductZoom;
		this.p1type = this.app.p1type;
		this.showOutfitThumb = true;
	},

/**
 * check if the current thumb should be shown
 * thumbs are organized/stored in an array in the following fashion: color thumbs|alt view thumbs|outfit thumbs
 * base on the current color selected index will jump between the 3 groups
 * @param index
 * @author yoshi
 */
	showThisThumb : function(index) {
		return index >= this.colorLength ||
			(index >= this.app.selectedColor * this.viewLength &&
					index < this.viewLength * (this.app.selectedColor+1));
	},

/**
 * generates thumbs html
 * @param {boolean} regenerate force html generation, even if html is already generated for this variant
 * @author yoshi
 */
	generateThumbs :  function(regenerate) {
	
		this.thumbContainer = $('imageThumbs' + (this.app.id||'') );		
		var objV = this.objV;
		this.colorSize = objV.arrayVariantStyleColors.size();
		this.colorLength = this.viewLength * this.colorSize;		
		var classThumbs='thumbs';
		var classThumbsSelected='thumbSelected';
		if(this.productClassTypId == brandConst.productClassTypeId.APPAREL && brandConst.BRAND_CODE == 4) {		
	    	classThumbs = 'thumbs fiveInARowThumbSize';
	    	classThumbsSelected='thumbSelected fiveInARowThumbSize';
		}
		if(objV.ProductImages.showThumbs) {
			if(!objV.thumbHTML || regenerate)  {
				/**
				 * helper functions for thumb html generation
				 * @param array
				 * @param thumb
				 * @param index
				 * @author yoshi
				 */
				var hlpContext = this;
				function generateThumbHelper(array, thumb, index) {
					if( hlpContext.showThisThumb(index)) {
						if(!(thumb.type == 'outfit') || hlpContext.showOutfitThumb) {
							array.push(hlpContext.THUMBSTAG.evaluate(
								{
									className: classThumbs,
									index : index,
									id : hlpContext.app.id||'',
									src : thumb.src,
									app : hlpContext.app.type,
									altText : thumb.altText
								}));
						}
					}
					return array;
				}
				var strHTML = [];
				objV.ProductImages.thumb.inject(strHTML, generateThumbHelper);
				objV.thumbHTML = strHTML.join('');
			 }
			this.thumbContainer.innerHTML = objV.thumbHTML;
			this.p1Thumbs = $$('#imageThumbs' + (this.app.id||'') + ' img:nth-of-type(-n+' + brandConst.perspViewLength[this.app.brandCode] + ')');
			this.selectedThumb = this.p1  = this.p1Thumbs[0];
			this.updateP1(this.app.selectedColor);
			this.p1.className = classThumbsSelected;
			this.selectedThumbIndex = this.app.selectedColor;
		 }
	},

/**
 * updates the main thumb, which is the 1st nth thumb, for BRONG it is the 1st thumb, for PL it is the 1st 7 thumb
 * @param i
 * @author yoshi
 */
	updateP1 : function(i) {
		var objV = this.objV, suffix = this.app.id||'';
        var viewLen = brandConst.perspViewLength[this.app.brandCode];
        for(var j=0; j<viewLen; j++ ) {
			var img = this.p1Thumbs[j];
			var counter = i * viewLen + j;
			img.src = objV.ProductImages.thumb[counter].src; 
			img.id = 'thumbImage' + counter + suffix;
			img.setAttribute('index', counter);
			if(img.src.endsWith('clear.gif') || img.src == '') {
				if(clientBrowser.isIE) {
					img.style.setAttribute('cssText', 'display:none');
				} else {
					img.setAttribute('style', 'display:none');					
				}
			}
			else {
				if(clientBrowser.isIE) {
					img.style.setAttribute('cssText', 'display:inline');
				} else {
					img.setAttribute('style', 'display:inline');					
				}
			}
		}
	},

/**
 * call from setcolor in GID.Browse.Base, sets color and update p1 accordingly
 * @param i
 * @param swatch
 * @author yoshi
 */
	setColor : function(i, swatch) {
		this.app.selectedColor = i;
		this.app.activeColor = i;
		this.app.selectedColorName = swatch.name;

		if(this.objV.ProductImages.showThumbs && this.thumbContainer) {
			this.updateP1(i);
			this.p1 = $('thumbImage' + i * brandConst.perspViewLength[this.app.brandCode] + (this.app.id||''));
		}
		this.setLargeImage(this.p1);

		if( this.zoom ) {
			this.zoom.setNoZoomMsg('');
			this.zoom.enableZoom = true;
		}
	},

/**
 * call when mouse over
 * @param index
 * @author yoshi
 */
	swatchOver : function(index) {
		this.app.activeColor = index;
		setImgSrc(this.app.p1Image, this.objV.ProductImages[this.p1type][index * brandConst.perspViewLength[this.app.brandCode]].src);
	},

/**
 *  called when mouse out
 * @author yoshi
 */
	swatchOut : function() {
		this.chgPreviewImg(null, 'out');
	},

/**
 * sets the main image src
 * @param imgs
 * @param index
 * @author yoshi
 */
	setP1Image : function(imgs, index) {
		var type = this.app.p1type;
        var isAthletaOutfit = imgs.thumb[index].type == 'outfit' && this.app.p1OutfitImage && this.app.brandCode == '10';
		if(index > imgs[type].length-1) {type = 'large';}
        var srcImg = isAthletaOutfit ? this.app.p1OutfitImage : this.app.p1Image;

        if(isAthletaOutfit) {
            this.app.p1Image.style.display = 'none';
            this.app.p1OutfitImage.style.display = 'inline';
        } else {
            this.app.p1Image.style.display = 'inline';
            if(this.app.p1OutfitImage) { this.app.p1OutfitImage.style.display = 'none'; }
        }
		srcImg.src = imgs[type][index].src;
	},

/**
 * fires omniture
 * @param shouldFire
 * @author yoshi
 */
	fireOmniture : function(shouldFire, fromViewLarger) {
		var app = this.parent || this.app;
		if(( !app.nanoViewClicked && shouldFire) || (!app.nanoViewClicked && fromViewLarger && shouldFire)) {
			app.nanoViewClicked = true;
			if (fromViewLarger){
				app.isFromViewLargerPopup = true;
			}
			if(!(reportingService||{}).isActive){
				omni.setAltViews(app.objP.strProductId);
			}
			else {
				this.app.setReportingService('altViews', app);
			}
		}
	},

/**
 * changes the thumb image and updates p1
 * @param btn
 * @param action
 * @param {boolean} isFromViewLarger flag to check if caller is from the view larger window
 * @author yoshi
 */
	chgPreviewImg : function(btn, action, isFromViewLarger) {
		var imgs = this.objV.ProductImages;
		var index = imgs.showThumbs && this.thumbContainer ? this.selectedThumbIndex : this.app.selectedColor * brandConst.perspViewLength[this.app.brandCode];
		var classThumbs='thumbs';
		var classThumbsSelected='thumbSelected';
		if(btn) {
			if(this.productClassTypId == brandConst.productClassTypeId.APPAREL && brandConst.BRAND_CODE == 4) {		
		    	classThumbs = 'thumbs fiveInARowThumbSize';
		    	classThumbsSelected='thumbSelected fiveInARowThumbSize';
			}
			btn.className = action=='over' ? classThumbsSelected : btn != this.selectedThumb ? classThumbs : classThumbsSelected;
			index = action=='over' ? Number(btn.getAttribute('index')) : index;
		}

		this.setP1Image(imgs, index);
		if(isFromViewLarger){
			this.fireOmniture(true, isFromViewLarger);
		}
	},

/**
 * updates p1 image when thumb is clicked
 * @param btn
 * @param {boolean} isFromThumb check to see if a thumb is clicked
 * @author yoshi
 */
	setLargeImage : function(btn, isFromThumb) {
		var objV = this.objV, imgs = objV.ProductImages;
		this.selectedColor = this.app.selectedColor;
		var index = this.selectedColor * brandConst.perspViewLength[this.app.brandCode];
		if(btn && imgs.showThumbs && this.thumbContainer ) {
			var isP1 = this.p1Thumbs.include(btn);
			var classThumbs='thumbs';
		    var classThumbsSelected='thumbSelected';
		    if(this.productClassTypId == brandConst.productClassTypeId.APPAREL && brandConst.BRAND_CODE == 4) {		
	    	    classThumbs = 'thumbs fiveInARowThumbSize';
	    	    classThumbsSelected='thumbSelected fiveInARowThumbSize';
		    }
			if(this.selectedThumb) { this.selectedThumb.className = classThumbs; }
			this.selectedThumbIndex = index = isP1 && this.p1Thumbs.length == 1 ? this.selectedColor : Number(btn.getAttribute('index'));
			this.selectedThumb = btn;
			btn.className = classThumbsSelected;
		}

		this.setP1Image(imgs, index);
		var fromViewLarger = this.type == "viewLarger";
		this.fireOmniture(isFromThumb, fromViewLarger);

		if(this.zoom) {
			this.zoom.dragImg.src = this.app.p1Image.src;
			this.zoom.zoomImg.src = imgs.large[index].src;
			var imgType = imgs.thumb[index].type;
			this.zoom.enableZoom = !(imgType == 'outfit');
		}

	}
};


