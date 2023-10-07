//**********************************************************************************************************************
//**********************************************************************************************************************
//** CSS ATTRIBUTES 
//**********************************************************************************************************************
//**********************************************************************************************************************

const g_arrayColorOptions = ["&lt;color&gt;", "Color name",  "HEX color", "HSL color", "RGB color"],
	  g_arrayImageOptions = ["&lt;image&gt;", "url(\"image.jpg\")", "url(\"image.png\")"],
	  g_arrayRepeatOptions = ["[repeat]", "repeat", "repeat-x", "repeat-y", "no-repeat"],
	  g_arratAttachmentOptions = ["[attachment]", "scroll", "fixed", "local"],
	  g_arrayPositionOptions = ["[position]", "top left", "top center", "top right", "center left", "center center", "center right", "bottom left", "bottom center", "bottom right"],
	  g_arraySizeOptions = ["[size]", "auto", "200px 100px", "10em 5em", "cover", "contain"],
	  g_arrayOriginOptions = ["[origin]", "padding-box", "border-box", "content-box"],
	  g_arrayClipOptions = ["[clip]", "padding-box", "border-box", "content-box"],
	  g_arrayBorderThicknessOptions = ["[width]", "thin", "medium", "thick", "#px", "#em", "#%"], 
	  g_arrayBorderStyleOptions = ["&lt;style&gt;", "none", "hidden", "dotted", "dashed", "solid", "double", "groove", "ridge", "inset", "outset"];


function GetBorderStyleCSS(strAttrib)
{
	if (strAttrib == "borderStyle")
	{
		strAttrib = "border-style";
	}
	else if (strAttrib == "borderLeftStyle")
	{
		strAttrib = "border-left-style";
	}
	else if (strAttrib == "borderRightStyle")
	{
		strAttrib = "border-right-style";
	}
	else if (strAttrib == "borderTopStyle")
	{
		strAttrib = "border-top-style";
	}
	else if (strAttrib == "borderBottomStyle")
	{
		strAttrib = "border-bottom-style";
	}
	return strAttrib;
}

function CreateCursorList(strAttrib)
{
	document.write("<ul>");
	document.write("<li style=\"cursor:alias;\"><b>alias: </b>the cursor indicates an alias of something is to be created.");
	document.write("<li style=\"cursor:all-scroll;\"><b>all-scroll: </b>the cursor indicates that something can be scrolled in any direction.");
	document.write("<li style=\"cursor:auto;\"><b>auto: </b>default - the browser sets a cursor.");
	document.write("<li style=\"cursor:cell;\"><b>cell: </b>the cursor indicates that a cell (or set of cells) may be selected.");
	document.write("<li style=\"cursor:context-menu;\"><b>context-menu: </b>the cursor indicates that a context-menu is available.");
	document.write("<li style=\"cursor:col-resize;\"><b>col-resize: </b>the cursor indicates that the column can be resized horizontally.");
	document.write("<li style=\"cursor:copy;\"><b>copy: </b>the cursor indicates something is to be copied.");
	document.write("<li style=\"cursor:crosshair;\"><b>crosshair: </b>the cursor render as a crosshair.");
	document.write("<li style=\"cursor:default;\"><b>default: </b>the default cursor.");
	document.write("<li style=\"cursor:e-resize;\"><b>e-resize: </b>the cursor indicates that an edge of a box is to be moved right (east).");
	document.write("<li style=\"cursor:ew-resize;\"><b>ew-resize: </b>indicates a bidirectional resize cursor.");
	document.write("<li style=\"cursor:help;\"><b>help: </b>the cursor indicates that help is available.");
	document.write("<li style=\"cursor:move;\"><b>move: </b>the cursor indicates something is to be moved.");
	document.write("<li style=\"cursor:n-resize;\"><b>n-resize: </b>the cursor indicates that an edge of a box is to be moved up (north).");
	document.write("<li style=\"cursor:ne-resize;\"><b>ne-resize: </b>the cursor indicates that an edge of a box is to be moved up and right (north/east).");
	document.write("<li style=\"cursor:nesw-resize;\"><b>nesw-resize: </b>indicates a bidirectional resize cursor.");
	document.write("<li style=\"cursor:ns-resize;\"><b>ns-resize: </b>indicates a bidirectional resize cursor.");
	document.write("<li style=\"cursor:nw-resize;\"><b>nw-resize: </b>the cursor indicates that an edge of a box is to be moved up and left (north/west).");
	document.write("<li style=\"cursor:nwse-resize;\"><b>nwse-resize: </b>indicates a bidirectional resize cursor.");
	document.write("<li style=\"cursor:no-drop;\"><b>no-drop: </b>the cursor indicates that the dragged item cannot be dropped here.");
	document.write("<li style=\"cursor:none;\"><b>none: </b>no cursor is rendered for the element.");
	document.write("<li style=\"cursor:not-allowed;\"><b>not-allowed: </b>the cursor indicates that the requested action will not be executed.");
	document.write("<li style=\"cursor:pointer;\"><b>pointer: </b>the cursor is a pointer and indicates a link.");
	document.write("<li style=\"cursor:progress;\"><b>progress: </b>the cursor indicates that the program is busy (in progress).");
	document.write("<li style=\"cursor:row-resize;\"><b>row-resize: </b>the cursor indicates that the row can be resized vertically.");
	document.write("<li style=\"cursor:s-resize;\"><b>s-resize: </b>the cursor indicates that an edge of a box is to be moved down (south).");
	document.write("<li style=\"cursor:se-resize;\"><b>se-resize: </b>the cursor indicates that an edge of a box is to be moved down and right (south/east).");
	document.write("<li style=\"cursor:sw-resize;\"><b>sw-resize: </b>the cursor indicates that an edge of a box is to be moved down and left (south/west).");
	document.write("<li style=\"cursor:text;\"><b>text: </b>the cursor indicates text that may be selected.");
	document.write("<li style=\"cursor:URL;\"><b>URL: </b>a comma separated list of URLs to custom cursors. Note: Always specify a generic cursor at the end of the list, in case none of the URL-defined cursors can be used.");
	document.write("<li style=\"cursor:vertical-text;\"><b>vertical-text: </b>the cursor indicates vertical-text that may be selected.");
	document.write("<li style=\"cursor:w-resize;\"><b>w-resize: </b>the cursor indicates that an edge of a box is to be moved left (west).");
	document.write("<li style=\"cursor:wait;\"><b>wait: </b>the cursor indicates that the program is busy.");
	document.write("<li style=\"cursor:zoom-in;\"><b>zoom-in: </b>the cursor indicates that something can be zoomed in.");
	document.write("<li style=\"cursor:zoom-out;\"><b>zoom-out: </b>the cursor indicates that something can be zoomed out.</ul>");
	if (strAttrib)
	{
		document.write("E.G.<p class=\"Code\">document.body.style." + strAttrib + " = \"move\";<br/></p>");
		document.write("E.G.<p class=\"Code\">console.log(document.body.style." + strAttrib + ");");
	}
}

function CreateClearList(strAttrib)
{
	document.write("<ul>");
	document.write("<li><b>none: </b>allows floating objects on both sides of the element. This is default.");
	document.write("<li><b>left: </b>no floating objects allowed on the left side of the element.");
	document.write("<li><b>right: </b>no floating objects allowed on the right side of the element.");
	document.write("<li><b>both: </b>no floating objects allowed on either the left or right side of the element.");
	document.write("</ul>");
	if (strAttrib)
	{
		document.write("E.G.<p class=\"Code\">document.body.style." + strAttrib + " = \"left\";<br/>");
		document.write("console.log(document.body.style." + strAttrib + ");</p>");
	}
}

function CreateDirectionList(strAttrib)
{
	document.write("<ul>");
	document.write("<li><b>ltr: </b>Text flows from left to right. This is default.");
	document.write("<li><b>rtl: </b>Text flows from right to left.");	
	document.write("</ul>");
	if (strAttrib)
	{
		document.write("E.G.<p class=\"Code\">document.body.style." + strAttrib + " = \"ltr\";<br/>");
		document.write("console.log(document.body.style." + strAttrib + ");</p>");
	}
}

function CreateDisplayList(strAttrib)
{
	document.write("<ul>");
	document.write("<li><b>block: </b>element is rendered as a block-level element.</li>");
	document.write("<li><b>compact: </b>element is rendered as a block-level or inline element. Depends on context.</li>");
	document.write("<li><b>flex: </b>element is rendered as a block-level flex box. New in CSS3.</li>");
	document.write("<li><b>inline: </b>element is rendered as an inline element. This is default.</li>");
	document.write("<li><b>inline-block: </b>element is rendered as a block box inside an inline box.</li>");
	document.write("<li><b>inline-flex: </b>element is rendered as a inline-level flex box. New in CSS3.</li>");
	document.write("<li><b>inline-table: </b>element is rendered as an inline table (like &lt;table&gt;), with no line break before or after the table.</li>");
	document.write("<li><b>list-item: </b>element is rendered as a list.</li>");
	document.write("<li><b>marker: </b>this value sets content before or after a box to be a marker (used with :before and :after pseudo-elements. Otherwise this value is identical to \"inline\").</li>");
	document.write("<li><b>none: </b>element will not be displayed.</li>");
	document.write("<li><b>run-in: </b>element is rendered as block-level or inline element. Depends on context.</li>");
	document.write("<li><b>table: </b>element is rendered as a block table (like &lt;table&gt;), with a line break before and after the table.</li>");
	document.write("<li><b>table-caption: </b>element is rendered as a table caption (like &lt;caption&gt;).</li>");
	document.write("<li><b>table-cell: </b>element is rendered as a table cell (like &lt;td&gt; and &lt;th&gt;).</li>");
	document.write("<li><b>table-column: </b>element is rendered as a column of cells (like &lt;col&gt;).</li>");
	document.write("<li><b>table-column-group: </b>element is rendered as a group of one or more columns (like &lt;colgroup&gt;).</li>");
	document.write("<li><b>table-footer-group: </b>element is rendered as a table footer row (like &lt;tfoot&gt;).</li>");
	document.write("<li><b>table-header-group: </b>element is rendered as a table header row (like &lt;thead>).</li>");
	document.write("<li><b>table-row: </b>element is rendered as a table row (like &lt;tr&gt;).</li>");
	document.write("<li><b>table-row-group: </b>element is rendered as a group of one or more rows (like &lt;tbody&gt;).</li>");
	document.write("</ul>");
	if (strAttrib)
	{
		document.write("E.G.<p class=\"Code\">document.body.style." + strAttrib + " = \"block\";<br/>");
		document.write("console.log(document.body.style." + strAttrib + ");</p>");
	}
}

function CreateCollapseList(strAttrib)
{
	document.write("<ul>");
	document.write("<li><b>separate: </b>Separate borders are drawn for all table cell elements. This is default.</li>");
	document.write("<li><b>collapse: </b>Borders are not drawn between table cell elements.</li>");
	document.write("</ul>");
	if (strAttrib)
	{
		document.write("E.G.<p class=\"Code\">document.body.style." + strAttrib + " = \"collapse\";<br/>");
		document.write("console.log(document.body.style." + strAttrib + ");</p>");
	}
}

function CreateOverflowList(strAttrib)
{
	document.write("<ul>");
	document.write("<li><b>visible: </b>content is NOT clipped and may be shown outside the element box. This is default.</li>");
	document.write("<li><b>hidden: </b>content outside the element box is not shown.</li>");
	document.write("<li><b>scroll: </b>scroll bars are added, and content is clipped when necessary.</li>");
	document.write("<li><b>auto: </b>content is clipped and scroll bars are added when necessary.</li>");
	document.write("</ul>");
	if (strAttrib)
	{
		document.write("E.G.<p class=\"Code\">document.body.style." + strAttrib + " = \"scroll\";<br/>");
		document.write("console.log(document.body.style." + strAttrib + ");</p>");
	}
}

function CreateBorderStyleList(strAttrib)
{
	document.write("<ul>");
	document.write("<li><b>none: </b>defines no border. This is default.<br/>E.G.<p class=\"Code\">" + strAttrib + " = \"none\";</p><div style=\"background-color:silver;width:10em;height:4em;" + GetBorderStyleCSS(strAttrib) + ":none;\"></div></li><br/>");
	document.write("<li><b>hidden: </b>same as 'none', except in border conflict resolution for table elements.</li><br/>E.G.<p class=\"Code\">" + strAttrib + " = \"hidden\";</p><div style=\"background-color:silver;width:10em;height:4em;" + GetBorderStyleCSS(strAttrib) + ":hidden;\"></div></li><br/>");
	document.write("<li><b>dotted: </b>defines a dotted border.</li><br/>E.G.<p class=\"Code\">" + strAttrib + " = \"dotted\";</p><div style=\"background-color:silver;width:10em;height:4em;" + GetBorderStyleCSS(strAttrib) + ":dotted;\"></div></li><br/>");
	document.write("<li><b>dashed: </b>defines a dashed border.</li><br/>E.G.<p class=\"Code\">" + strAttrib + " = \"dashed\";</p><div style=\"background-color:silver;width:10em;height:4em;" + GetBorderStyleCSS(strAttrib) + ":dashed;\"></div></li><br/>");
	document.write("<li><b>solid: </b>defines a solid border.</li><br/>E.G.<p class=\"Code\">" + strAttrib + " = \"solid\";</p><div style=\"background-color:silver;width:10em;height:4em;" + GetBorderStyleCSS(strAttrib) + ":solid;\"></div></li><br/>");
	document.write("<li><b>double: </b>defines two borders. The width of the two borders are the same as the border-width value.</li><br/>E.G.<p class=\"Code\">" + strAttrib + " = \"double\";</p><div style=\"background-color:silver;width:10em;height:4em;" + GetBorderStyleCSS(strAttrib) + ":double;\"></div></li><br/>");
	document.write("<li><b>groove: </b>defines a 3D grooved border. The effect depends on the border-color value.</li><br/>E.G.<p class=\"Code\">" + strAttrib + " = \"groove\";</p><div style=\"background-color:silver;width:10em;height:4em;" + GetBorderStyleCSS(strAttrib) + ":groove;\"></div></li><br/>");
	document.write("<li><b>ridge: </b>defines a 3D ridged border. The effect depends on the border-color value.</li><br/>E.G.<p class=\"Code\">" + strAttrib + " = \"ridge\";</p><div style=\"background-color:silver;width:10em;height:4em;" + GetBorderStyleCSS(strAttrib) + ":ridge;\"></div></li><br/>");
	document.write("<li><b>inset: </b>Defines a 3D inset border. The effect depends on the border-color value.</li><br/>E.G.<p class=\"Code\">" + strAttrib + " = \"inset\";</p><div style=\"background-color:silver;width:10em;height:4em;" + GetBorderStyleCSS(strAttrib) + ":inset;\"></div></li><br/>");
	document.write("<li><b>outset: </b>defines a 3D outset border. The effect depends on the border-color value.</li>E.G.<p class=\"Code\">" + strAttrib + " = \"outset\";</p><div style=\"background-color:silver;width:10em;height:4em;" + GetBorderStyleCSS(strAttrib) + ":outset;\"></div></li><br/>");
	document.write("</ul>");
	if (strAttrib)
	{
		document.write("E.G.<p class=\"Code\">document.body.style." + strAttrib + " = \"double\";<br/>");
		document.write("console.log(document.body.style." + strAttrib + ");</p>");
	}
}

function CreateRepeatList(strAttrib)
{
	document.write("<ul>");
	document.write("<li><b>repeat: </b>the background image is repeated both vertically and horizontally. This is default.</li>");
	document.write("<li><b>repeat-x: </b>the background image is only repeated horizontally.</li>");	document.write("<li><b>repeat-y: </b>the background image is only repeated vertically.</li>");
	document.write("<li><b>no-repeat: </b>the background-image is not repeated.</li>");
	document.write("</ul>");
	if (strAttrib)
	{
		document.write("E.G.<p class=\"Code\">document.body.style." + strAttrib + " = \"no-repeat\";<br/>");
		document.write("console.log(document.body.style." + strAttrib + ");</p>");
	}
}

function CreateLengthList(strAttrib)
{
	document.write("<ul>");
	document.write("<li>");
	document.write("<b>em: </b><br/>");
	document.write("E.G.");
	document.write("<p class=\"Code\">");
	document.write("document.body.style." + strAttrib + " = \"10em\";<br/>");
	document.write("console.log(document.body.style." + strAttrib + ");");
	document.write("</p>");
	document.write("</li>");
	document.write("<li>");
	document.write("<b>px: </b><br/>");
	document.write("E.G.");
	document.write("<p class=\"Code\">");
	document.write("document.body.style." + strAttrib + "= \"200px\";<br/>");
	document.write("console.log(document.body.style." + strAttrib + ");");
	document.write("</p>");
	document.write("</li>");
	document.write("<li>");
	document.write("<b>%: </b><br/>");
	document.write("E.G.");
	document.write("<p class=\"Code\">");
	document.write("document.body.style." + strAttrib + "= \"10%\";<br/>");
	document.write("console.log(document.body.style." + strAttrib + ");");
	document.write("</p>");
	document.write("</li>");
	document.write("</ul>");
}

function CreateVertAlignList(strAttrib)
{
	document.write("<ul>");
	document.write("<li><b>length: </b>raises or lower an element by the specified length. Negative values are allowed");
	document.write("<li><b>%: </b>raises or lower an element in a percent of the 'line-height' property. Negative values are allowed");
	document.write("<li><b>baseline: </b>align the baseline of the element with the baseline of the parent element. This is default");
	document.write("<li><b>sub: </b>aligns the element as it was subscript");
	document.write("<li><b>super: </b>aligns the element as it was superscript");
	document.write("<li><b>top: </b>the top of the element is aligned with the top of the tallest element on the line");
	document.write("<li><b>text-top: </b>the top of the element is aligned with the top of the parent element's font");
	document.write("<li><b>middle: </b>the element is placed in the middle of the parent element");
	document.write("<li><b>bottom: </b>the bottom of the element is aligned with the lowest element on the line");
	document.write("<li><b>text-bottom: </b>the bottom of the element is aligned with the bottom of the parent element's font");
	document.write("</ul>");
	if (strAttrib)
	{
		document.write("E.G.<p class=\"Code\">document.body.style." + strAttrib + " = \"absolute\";<br/>");
		document.write("console.log(document.body.style." + strAttrib + ");</p>");
	}
}

function CreateVisibilityList(strAttrib)
{
	document.write("<ul>");
	document.write("<li><b>visible: </b>the element is visible. This is default.");
	document.write("<li><b>hidden: </b>the element is not visible, but still affects layout.");
	document.write("<li><b>collapse: </b>when used on a table row or cell, the element is not visible (same as 'hidden').");	
	document.write("</ul>");
	if (strAttrib)
	{
		document.write("E.G.<p class=\"Code\">document.body.style." + strAttrib + " = \"visible\";<br/>");
		document.write("console.log(document.body.style." + strAttrib + ");</p>");
	}
}

function CreatePositionList(strAttrib)
{
	document.write("<ul>");
	document.write("<li><b>static: </b>elements renders in order, as they appear in the document flow. This is default.</li>");
	document.write("<li><b>absolute: </b>the element is positioned relative to its first positioned (not static) ancestor element.</li>");
	document.write("<li><b>fixed: </b>the element is positioned relative to the browser window.</li>");
	document.write("<li><b>relative: </b>the element is positioned relative to its normal position, so 'left:20' adds 20 pixels to the element's LEFT position.</li>");
	document.write("<li><b>sticky: </b>the element is positioned based on the user's scroll position. A sticky element toggles between relative and fixed, depending on the scroll position. It is positioned relative until a given offset position is met in the viewport - then it 'sticks' in place (like position:fixed).<br/><b>Note: <b/>Not supported in IE/Edge 15 or earlier. Supported in Safari from version 6.1 with a Webkit prefix.</li>");	
	document.write("</ul>");
	if (strAttrib)
	{
		document.write("E.G.<p class=\"Code\">document.body.style." + strAttrib + " = \"absolute\";<br/>");
		document.write("console.log(document.body.style." + strAttrib + ");</p>");
	}
}

function CreateResizeList(strAttrib)
{
	document.write("<ul>");
		
	document.write("<li><b>none: </b>tDefault value. The user cannot resize the element.</li>");
	document.write("<li><b>both: </b>tThe user can adjust both the height and the width of the element.</li>");
	document.write("<li><b>horizontal: </b>tThe user can adjust the width of the element.</li>");
	document.write("<li><b>vertical: </b>tThe user can adjust the height of the element.</li>");
	document.write("</ul>");
	if (strAttrib)
	{
		document.write("E.G.<p class=\"Code\">document.body.style." + strAttrib + " = \"content-box\";<br/>");
		document.write("console.log(document.body.style." + strAttrib + ");</p>");
	}
}

function CreateSizeList(strAttrib)
{
	document.write("<ul>");
	document.write("<li>");
	document.write("<b>em: </b><br/>");
	document.write("E.G.");
	document.write("<p class=\"Code\">");
	document.write("document.body.style." + strAttrib + " = \"10em 5em\";<br/>");
	document.write("console.log(document.body.style." + strAttrib + ");");
	document.write("</p>");
	document.write("</li>");
	document.write("<li>");
	document.write("<b>px: </b><br/>");
	document.write("E.G.");
	document.write("<p class=\"Code\">");
	document.write("document.body.style." + strAttrib + " = \"200px 100px\";<br/>");
	document.write("console.log(document.body.style." + strAttrib + ");");
	document.write("</p>");
	document.write("</li>");
	document.write("<li>");
	document.write("<b>%: </b><br/>");
	document.write("E.G.");
	document.write("<p class=\"Code\">");
	document.write("document.body.style." + strAttrib + " = \"10% 10%\";<br/>");
	document.write("console.log(document.body.style." + strAttrib + ");");
	document.write("</p>");
	document.write("</li>");
	document.write("</ul>");
}

function CreateClipOriginList(strAttrib)
{
	document.write("<ul>");
	document.write("<li><b>border-box: </b>default value. The background is clipped to the border box.</li>");
	document.write("<li><b>padding-box: </b>the background is clipped to the padding box.</li>");
	document.write("<li><b>content-box: </b>the background is clipped to the content box.</li>");
	document.write("</ul>");
	if (strAttrib)
	{
		document.write("E.G.<p class=\"Code\">document.body.style." + strAttrib + " = \"border-box\";<br/>");
		document.write("console.log(document.body.style." + strAttrib + ");</p>");
	}
}

function CreatePositionList(strAttrib)
{
	document.write("<ul>");
	document.write("<li><b>: top left</b></li>");
	document.write("<li><b>: top center</b></li>");
	document.write("<li><b>: top right</b></li>");
	document.write("<li><b>: center left</b></li>");
	document.write("<li><b>: center center</b></li>");
	document.write("<li><b>: center right</b></li>");
	document.write("<li><b>: bottom left</b></li>");
	document.write("<li><b>: bottom center</b></li>");
	document.write("<li><b>: bottom right</b></li>");									
	document.write("</ul>");
	if (strAttrib)
	{
		document.write("E.G.<p class=\"Code\">document.body.style." + strAttrib + " = \"top right\";<br/>");
		document.write("console.log(document.body.style." + strAttrib + ");</p>");
	}
}

function CreateImageList(strAttrib)
{
	document.write("<ul>");
	document.write("<li><b>url(\"image.jpg\")</b></li>");
	document.write("<li><b>url(\"image.png\")</b></li>");
	document.write("</ul>");
	if (strAttrib)
	{
		document.write("E.G.<p class=\"Code\">document.body.style." + strAttrib + " = \"url('image.png')\";<br/>");
		document.write("console.log(document.body.style." + strAttrib + ");</p>");
	}
}

function CreateAttachmentList(strAttrib)
{
	document.write("<ul>");
	document.write("<li><b>scroll: </b>the background scrolls along with the element. This is default.</li>");
	document.write("<li><b>fixed: </b>the background is fixed with regard to the viewport.</li>");
	document.write("<li><b>local: </b>the background scrolls along with the element's contents.</li>");
	document.write("</ul>");
	if (strAttrib)
	{
		document.write("E.G.<p class=\"Code\">document.body.style." + strAttrib + " = \"scroll\";<br/>");
		document.write("console.log(document.body.style." + strAttrib + ");</p>");
	}
}

function CreateColorList(strAttrib)
{
	document.write("<ul>");
	document.write("<li><b>Color name: </b>e.g. \"teal\"</li>");
	document.write("<li><b>HEX color: </b>e.g. #4502C3</li>");
	document.write("<li><b>HSL color: </b>e.g. hsl(30, 50%, 50%)</li>");
	document.write("<li><b>RGB color: </b>e.g. rgb(255, 50, 1)</li>");
	document.write("</ul>");
	if (strAttrib)
	{
		document.write("E.G.<p class=\"Code\">document.body.style." + strAttrib + " = \"teal\";<br/>");
		document.write("console.log(document.body.style." + strAttrib + ");</p>");
	}
}

function CreateFontVariantList(strAttrib)
{
	document.write("<ul>");
	document.write("<li><b>normal: </b>font is normal. This is default.</li>");
	document.write("<li><b>small-caps: </b>font is displayed in small capital letters.</li>");
	document.write("<ul>");
	if (strAttrib)
	{
		document.write("E.G.<p class=\"Code\">document.body.style." + strAttrib + " = \"small-caps\";<br/>");
		document.write("console.log(document.body.style." + strAttrib + ");</p>");
	}
}

function CreateListStyleTypeList(strAttrib)
{
	document.write("<ul>");
	document.write("<li><b>armenian: </b>the marker is traditional Armenian numbering.</li>");
	document.write("<li><b>circle: </b>the marker is a circle.</li>");
	document.write("<li><b>cjk-ideographic: </b>the marker is plain ideographic numbers.</li>");
	document.write("<li><b>decimal: </b>the marker is a number. This is default for &ltol&gt;.</li>");
	document.write("<li><b>decimal-leading-zero: </b>the marker is a number with leading zeros (01, 02, 03, etc.).</li>");
	document.write("<li><b>disc: </b>the marker is a filled circle. This is default for &lt;ul&gt;.</li>");
	document.write("<li><b>georgian: </b>the marker is traditional Georgian numbering.</li>");
	document.write("<li><b>hebrew: </b>the marker is traditional Hebrew numbering.</li>");
	document.write("<li><b>hiragana: </b>the marker is traditional Hiragana numbering.</li>");
	document.write("<li><b>hiragana-iroha: </b>the marker is traditional Hiragana iroha numbering.</li>");
	document.write("<li><b>katakana: </b>the marker is traditional Katakana numbering.</li>");
	document.write("<li><b>katakana-iroha: </b>the marker is traditional Katakana iroha numbering.</li>");
	document.write("<li><b>lower-alpha: </b>the marker is lower-alpha (a, b, c, d, e, etc.).</li>");
	document.write("<li><b>lower-greek: </b>the marker is lower-greek.</li>");
	document.write("<li><b>lower-latin: </b>the marker is lower-latin (a, b, c, d, e, etc.).</li>");
	document.write("<li><b>lower-roman: </b>the marker is lower-roman (i, ii, iii, iv, v, etc.).</li>");
	document.write("<li><b>none: </b>no marker is shown.</li>");
	document.write("<li><b>square: </b>the marker is a square.</li>");
	document.write("<li><b>upper-alpha: </b>the marker is upper-alpha (A, B, C, D, E, etc.).</li>");
	document.write("<li><b>upper-latin: </b>the marker is upper-latin (A, B, C, D, E, etc.).</li>");
	document.write("<li><b>upper-roman: </b>the marker is upper-roman (I, II, III, IV, V, etc.).</li>");
	document.write("</ul>");
	if (strAttrib)
	{
		document.write("E.G.<p class=\"Code\">document.body.style." + strAttrib + " = \"square\";<br/>");
		document.write("console.log(document.body.style." + strAttrib + ");</p>");
	}
}

function CreateListStylePositionList(strAttrib)
{
	document.write("<ul>");
	document.write("<li><b>outside: </b>the list-item marker will be rendered before any text content. This is default.</li>");
	document.write("<li><b>inside: </b>indents the list-item marker marker.</li>");
	document.write("</ul>");
	if (strAttrib)
	{
		document.write("E.G.<p class=\"Code\">document.body.style." + strAttrib + " = \"italic\";<br/>");
		document.write("console.log(document.body.style." + strAttrib + ");</p>");
	}
}

function CreateFontStyleList(strAttrib)
{
	document.write("<ul>");
	document.write("<li><b>normal: </b>font is normal. This is default.</li>");
	document.write("<li><b>italic: </b>font is in italic.</li>");
	document.write("<li><b>oblique: </b>font is in oblique.</li>");
	document.write("</ul>");
	if (strAttrib)
	{
		document.write("E.G.<p class=\"Code\">document.body.style." + strAttrib + " = \"oblique\";<br/>");
		document.write("console.log(document.body.style." + strAttrib + ");</p>");
	}
}

function CreateOrientationList(strAttrib)
{
	document.write("<ul>");

	document.write("</ul>");
	if (strAttrib)
	{
		document.write("E.G.<p class=\"Code\">document.body.style." + strAttrib + " = \"x-small\";<br/>");
		document.write("console.log(document.body.style." + strAttrib + ");</p>");
	}
}

function CreateFontStretchList(strAttrib)
{
	document.write("<ul>");
	document.write("<li><b>ultra-condensed: </b>makes the text as narrow as it gets.</li>");
	document.write("<li><b>extra-condensed: </b>makes the text narrower than condensed, but not as narrow as ultra-condensed.</li>");
	document.write("<li><b>condensed: </b>makes the text narrower than semi-condensed, but not as narrow as extra-condensed.</li>");
	document.write("<li><b>semi-condensed: </b>makes the text narrower than normal, but not as narrow as condensed.</li>");
	document.write("<li><b>normal: </b>the default value. No font stretching.</li>");
	document.write("<li><b>semi-expanded: </b>makes the text wider than normal, but not as wide as expanded.</li>");
	document.write("<li><b>expanded: </b>makes the text wider than semi-expanded, but not as wide as extra-expanded.</li>");
	document.write("<li><b>extra-expanded: </b>makes the text wider than expanded, but not as wide as ultra-expanded.</li>");
	document.write("<li><b>ultra-expanded: </b>makes the text as wide as it gets.</li>");	
	document.write("<li><b>lighter: </b>font is lighter.</li>");
	document.write("</ul>");
	if (strAttrib)
	{
		document.write("E.G.<p class=\"Code\">document.body.style." + strAttrib + " = \"expanded\";<br/>");
		document.write("console.log(document.body.style." + strAttrib + ");</p>");
	}
}

function CreateFontWeightList(strAttrib)
{
	document.write("<ul>");
	document.write("<li><b>lighter: </b>font is lighter.</li>");
	document.write("<li><b>bold: </b>font is bold.</li>");
	document.write("<li><b>bolder: </b>font is bolder.</li>");
	document.write("<li><b>100</b></li>");
	document.write("<li><b>200</b></li>");
	document.write("<li><b>300</b></li>");
	document.write("<li><b>400: </b>same as 'normal'.</li>");
	document.write("<li><b>500</b></li>");
	document.write("<li><b>600</b></li>");
	document.write("<li><b>700: </b>same as 'bold'.</li>");
	document.write("<li><b>800</b></li>");
	document.write("<li><b>900</b></li>");
	document.write("</ul>");
	if (strAttrib)
	{
		document.write("E.G.<p class=\"Code\">document.body.style." + strAttrib + " = \"100\";<br/>");
		document.write("console.log(document.body.style." + strAttrib + ");</p>");
	}
}

function CreateFontSizeList(strAttrib)
{
	document.write("<ul>");
	document.write("<li><b>xx-small</b></li>");
	document.write("<li><b>x-small</b></li>");
	document.write("<li><b>small</b></li>");
	document.write("<li><b>medium</b></li>");
	document.write("<li><b>large</b></li>");
	document.write("<li><b>x-large</b></li>");
	document.write("<li><b>xx-large: </b>Sets the size of the font to different fixed sizes, from xx-small to xx-large.</li>");
	document.write("<li><b>smaller: </b>Decreases the font-size by one relative unit.</li>");
	document.write("<li><b>larger: </b>Increases the font-size by one relative unit.</li>");
	document.write("<li><b>Explicit size: </b>");
	CreateLengthList(strAttrib);
	document.write("</li>");
	document.write("</ul>");
	if (strAttrib)
	{
		document.write("E.G.<p class=\"Code\">document.body.style." + strAttrib + " = \"large\";<br/>");
		document.write("console.log(document.body.style." + strAttrib + ");</p>");
	}
}

function MakeAttributeOptionsRow(arrayStyleAttributes)
{
	document.write("<td><select>");
	for (let nI = 1; nI < arrayStyleAttributes.length; nI++)
	{
		if (nI == 1)
			document.write("<option selected>");
		else
			document.write("<option>");
		document.write(arrayStyleAttributes[nI]);
		document.write("</option>");
	}
	document.write("</select></td>");
}

function MakeAttributeOptions()
{
	let strText = "";
	
	if (arguments.length > 0)
	{
		//document.write("<table border=\"1\" cellspacing=\"0\" style=\"display:inline;\"><tr><td><b>\"</b></td>");
		document.write("<table style=\"display:inline;\"><tr><td><b>\"</b></td>");
	
		for (let nI = 0; nI < arguments.length; nI++) 
		{
		    if (Array.isArray(arguments[nI]))
		    {
		    	document.write("<td style=\"padding-right:5px;\">" + arguments[nI][0] + "</td>");
		    	MakeAttributeOptionsRow(arguments[nI]);
		    }
		    else
		    {
		    	document.write(arguments[nI]);
		    }
		}
		document.write("<td><b>\";</b></td></tr>");
		document.write("</tr></table><br/<br/>");
	}
}

//**********************************************************************************************************************
//**********************************************************************************************************************
//** INFO POPUPS 
//**********************************************************************************************************************
//**********************************************************************************************************************


let g_mapDialogs = new Map();

function DoOpenInfoPopup(strID, strWebPage)
{
	let strHTML = "<iframe id=\"info_popup_iframe_" + strID + "\" class=\"info_popup_iframe\" src=\"" + 
					strWebPage + "\"></iframe><br/><br/>" +
					"<input type=\"button\" id=\"CloseButton\" value=\"CLOSE\" style=\"width:80px;\" " + 
					"\" onclick=\"DoCloseInfoPopup(this.parentNode)\"/>";
	let nDelta = 20, nLeft = 0, nTop = 0;

	if (!g_mapDialogs.has(strID))
	{
		let dialog = document.createElement("dialog");
		dialog.id = "info_popup_" + strID;
		dialog.innerHTML = strHTML;
		dialog.className = "info_popup_container";
		document.body.appendChild(dialog);
		
		if (g_mapDialogs.size > 0)
		{
			let element = Array.from(g_mapDialogs.values()).pop();
			nLeft = element.clientLeft; 
			nTop = element.clientTop;
			dialog.style.left = (nLeft + nDelta).toString() + "px";
			dialog.style.top = (nTop + nDelta).toString() + "px";
		}
		g_mapDialogs.set(strID, dialog);			
		dialog.style.display = "block";
	}
}

function DoCloseInfoPopup(dialogPopupContainer)
{
	if (dialogPopupContainer)
	{
		let strID = dialogPopupContainer.id;
		strID = strID.replace("info_popup_", "");
		g_mapDialogs.delete(strID);
		dialogPopupContainer.remove();
	}
}

//**********************************************************************************************************************
//**********************************************************************************************************************
//** TEST YOURSELF FUNCTIONS
//**********************************************************************************************************************
//**********************************************************************************************************************

let g_arrayQuestions = [];
let g_nStageNum = 0;

function OnClickSubmitAnswers(g_arrayQuestions)
{
	let divAnswers = document.getElementById("Answers");
	
	if (divAnswers)
	{
		GenerateAnswers(g_arrayQuestions);
		divAnswers.style.display = "block";
	}
}

function GetTryItNowCode(nQuestionNum, strCode)
{
	let divTryItNow = document.getElementById("TryItNowHTML");
	let strTryItNowCode = "";
	
	if (divTryItNow)
	{
		strTryItNowCode = divTryItNow.innerHTML;
		strTryItNowCode = strTryItNowCode.replace("id=\"TryItNowCode", "id=\"TryItNowCode" + nQuestionNum.toString());
		strTryItNowCode = strTryItNowCode.replace("id=\"TryItNowResults", "id=\"TryItNowResults" + nQuestionNum.toString());
		strTryItNowCode = strTryItNowCode.replace("OnClickButtonRun()", "OnClickButtonRun(" + nQuestionNum.toString() + ")");
		if (strCode)
			strTryItNowCode = strTryItNowCode.replace("XXXX", strCode);
		else
			strTryItNowCode = strTryItNowCode.replace("XXXX", "");
		g_arrayQuestions[nQuestionNum].strID = "TryItNowCode" + nQuestionNum.toString();
	}
	return strTryItNowCode;
}

function GenerateQuestions(g_arrayQuestions)
{
	let strButton = "";
		
	document.write("<ol>");
	for (let nI = 0; nI < g_arrayQuestions.length; nI++)
	{
		document.write("<li><b>" + GetAsHTMLCode([g_arrayQuestions[nI].strQuestion]) + "</b></li>");
		if (g_arrayQuestions[nI].strType == "code")
		{
			document.write(GetTryItNowCode(nI));
		}
		else if (g_arrayQuestions[nI].strType == "multiple")
		{
			document.write("<p>");
			let strChecked = " checked";
			for (let nJ = 0; nJ < g_arrayQuestions[nI].arrayOptions.length; nJ++)
			{
				let strText = "<input type=\"radio\" name=\"Option\" id=\"Question" + nI.toString() + "_" + nJ.toString() + 
					"\"" + strChecked + "\">" + 
					"<label for=\"Question" + nI.toString() + "_" + nJ.toString() + "\">" + GetAsHTMLCode([g_arrayQuestions[nI].arrayOptions[nJ]]) + 
					"</label><br/>";
				document.write(strText);
				strChecked = "";
			}
			g_arrayQuestions[nI].strID = "Question" + nI.toString();
		}
		document.write("<br/>");
	}
	document.write("</ol><br/><input type=\"button\" value=\"SUBMIT ANSWERS\" onclick=\"OnClickSubmitAnswers(g_arrayQuestions)\">");
}

function GetYourAnswer(nQuestionNum, structQuestion)
{
	let strAnswer = "";
	let strID = "";
	let input = null;
	
	if (structQuestion.strType == "code")
	{
		input = document.getElementById(structQuestion.strID);
		if (input)
		{
			strAnswer = input.value;
		}
		else
		{
			strAnswer = "Input with ID '" + structQuestion.strID + "' not found!";
		}
	}
	else if (structQuestion.strType == "multiple")
	{
		for (let nI = 0; nI < structQuestion.arrayOptions.length; nI++)
		{
			strID = "Question" + nQuestionNum.toString() + "_" + nI.toString();
			input = document.getElementById(strID);
			if (input && input.checked)
			{
				strAnswer = structQuestion.arrayOptions[nI];
			}
		}
	}
	return strAnswer;
}

function GetTickOrCross(structQuestion)
{
	let strHTML = "<img src=\"images/Cross.png\" alt=\"images/Cross.png\" width=\"20\" style=\"position:relative;top:5px;padding-left:20px;\">";
	let strHTMLTick = "<img src=\"images/Tick.png\" alt=\"images/Tick.png\" width=\"20\" style=\"position:relative;top:5px;padding-left:20px;\">";
	
	if (structQuestion.strType == "code")
	{
		let nLastIndex = -1, nCurrentIndex = 0, nMaxIndex = 0, bValid = true;
		
		for (let nI = 0; nI < structQuestion.arrayCorrectParts.length; nI++)
		{
			if (Array.isArray(structQuestion.arrayCorrectParts[nI]))
			{
				for (let nJ = 0; nJ < structQuestion.arrayCorrectParts[nI].length; nJ++)
				{
					nCurrentIndex = structQuestion.strAnswer.indexOf(structQuestion.arrayCorrectParts[nI][nJ]);
					if (nCurrentIndex > nLastIndex)
					{
						if (nCurrentIndex > nMaxIndex)
							nMaxIndex = nCurrentIndex;
					}
					else
					{
						bValid = false;
						break;
					}
				}
				if (!bValid)
				{
					break;
				}
				else
				{
					nLastIndex = nMaxIndex;
				}
			}
			else
			{
				nCurrentIndex = structQuestion.strAnswer.indexOf(structQuestion.arrayCorrectParts[nI], nLastIndex);
				if (nCurrentIndex > nLastIndex)
				{
					nLastIndex = nCurrentIndex;
				}
				else
				{
					bValid = false;
					break;
				}
			}
		}
		/*
			name=" id=""
			name=X" id="!"
			name=X" id="! 
			
			letters, digits, hyphens, underscores, colons and periods.
			- _ : .
		*/
		bValid  = structQuestion.strAnswer.indexOf("=\" ") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"/") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"/") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"~") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"`") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"!") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"@") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"#") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"$") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"%") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"^") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"&") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"*") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"(") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\")") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"=") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"+") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"{") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"[") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"}") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"]") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"|") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"\\") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\";") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"'") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"?") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"/") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"<") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\",") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\">") == -1;
		
		if (bValid)
		{
			strHTML = strHTMLTick;
			g_nScore++;
		}
	}
	else if (structQuestion.strType == "multiple")
	{
		if (structQuestion.strAnswer == structQuestion.arrayOptions[structQuestion.nCorrectOption])
		{
			strHTML = strHTMLTick;
			g_nScore++;
		}
	}
	return strHTML;
}

function GenerateAnswers(g_arrayQuestions)
{
	let divAnswers = document.getElementById("Answers");
	let strAnswers = "<p><h3><u>CORRECT ANSWERS</u></h3>";
	
	if (divAnswers)
	{
		for (let nI = 0; nI < g_arrayQuestions.length; nI++)
		{
			strAnswers += "<b>" + (nI + 1).toString() + ". </b>";
			if (g_arrayQuestions[nI].strType == "code")
			{
				strAnswers += GetAsHTMLCode([g_arrayQuestions[nI].strCorrectAnswer]) + "<br/><br/>";
			}
			else if (g_arrayQuestions[nI].strType == "multiple")
			{
				strAnswers += g_arrayQuestions[nI].arrayOptions[g_arrayQuestions[nI].nCorrectOption] + "<br/><br/>";
			}
			g_arrayQuestions[nI].strAnswer = GetYourAnswer(nI, g_arrayQuestions[nI]);
			strAnswers += "<b style=\"color:red;\">YOUR ANSWER: </b>" + GetAsHTMLCode(g_arrayQuestions[nI].strAnswer) + 
						GetTickOrCross(g_arrayQuestions[nI]) + "<br/><br/><hr><br/>";
		}
		strAnswers += "<p><b style=\"color:red;\">YOUR SCORE: </b><b>" + g_nScore.toString() + " / " + 
			g_arrayQuestions.length.toString() + "</b> or <b>" + ((g_nScore * 100)/ g_arrayQuestions.length).toString() + 
			"%</b></p>";
		divAnswers.innerHTML = strAnswers + "</p>";
		g_nScore = 0;
	}
}

function OnClickButtonRun(nQuestionNum)
{
	let textareaTryItNowCode = document.getElementById("TryItNowCode" + nQuestionNum.toString());
	let iframeTryItNowResults = document.getElementById("TryItNowResults" + nQuestionNum.toString());
	
	if (textareaTryItNowCode && iframeTryItNowResults)
	{
		g_arrayQuestions[nQuestionNum].strAnswer = textareaTryItNowCode.value;
		iframeTryItNowResults.srcdoc = textareaTryItNowCode.value;
	}
}

//**********************************************************************************************************************
//**********************************************************************************************************************
//** COURSE FUNCTIONS
//**********************************************************************************************************************
//**********************************************************************************************************************

var g_arrayStageBookmarks = [];
var g_nScore = 0;

function DoHighlightCurrentStageLink(strIDLink2Highlight, strIDLink2Unhighlight)
{
	let headingStage2Highlight = document.getElementById(strIDLink2Highlight);
	let headingStage2Unhighlight = document.getElementById(strIDLink2Unhighlight);
	
	if (headingStage2Highlight)
	{
		let strIDLink2Highlight = headingStage2Highlight.innerText;
		let link2Highlight = document.getElementById(strIDLink2Highlight);
		
		if (link2Highlight)
		{
			link2Highlight.style.backgroundColor = "#DDCC99";
			link2Highlight.style.color = "red";
		}
	}
	if (headingStage2Unhighlight)
	{
		let strIDLink2Unhighlight = headingStage2Unhighlight.innerText;
		let link2Unhighlight = document.getElementById(strIDLink2Unhighlight);
		
		if (link2Unhighlight)
		{
			link2Unhighlight.style.backgroundColor = "#CCBB88";
			link2Unhighlight.style.color = "navy";
		}
	}
}

function SetPaymentLevel()
{
	let strCountry = GetUserCountry();
	
	if ((strCountry == "United States") || (strCountry == "Canada") || (strCountry == "Antarctica") || (strCountry == "Australia") || 
		(strCountry == "Switzerland") || (strCountry == "Germany") || (strCountry == "Christmas Island") || (strCountry == "Denmark") || 
		(strCountry == "Spain") || (strCountry == "Finland") || (strCountry == "Falkland Islands") || (strCountry == "France") || 
		(strCountry == "Britain (UK)") || (strCountry == "Gibraltar") || (strCountry == "Greenland") || (strCountry == "Ireland") || 
		(strCountry == "Israel") || (strCountry == "Iceland") || (strCountry == "Italy") || (strCountry == "Japan") || 
		(strCountry == "Korea (South)") || (strCountry == "Luxembourg") || (strCountry == "Norfolk Island") || 
		(strCountry == "Netherlands") || (strCountry == "Norway") || (strCountry == "New Zealand") || (strCountry == "Poland") || 
		(strCountry == "Portugal") || (strCountry == "Sweden") || (strCountry == "`") || (strCountry == "Vatican City") || 
		(strCountry == "Saudi Arabia") || (strCountry == "Taiwan") || (strCountry == "Belgium") || (strCountry == "Bulgaria") || 
		(strCountry == "Bermuda") || (strCountry == "Cyprus") || (strCountry == "Czech Republic") || (strCountry == "Estonia") || 
		(strCountry == "Micronesia") || (strCountry == "Greece") || (strCountry == "Guam") || (strCountry == "Kiribati") || 
		(strCountry == "Lithuania") || (strCountry == "Latvia") || (strCountry == "Monaco") || (strCountry == "Marshall Islands") || 
		(strCountry == "Malta") || (strCountry == "Panama") || (strCountry == "Pitcairn") || (strCountry == "Puerto Rico") || 
		(strCountry == "Palau") || (strCountry == "Paraguay") || (strCountry == "Réunion") || (strCountry == "Turkey") || 
		(strCountry == "US minor outlying islands") || (strCountry == "osnia & Herzegovina") || (strCountry == "Bahrain") || 
		(strCountry == "Benin") || (strCountry == "St Barthelemy") || (strCountry == "Bahamas") || (strCountry == "Guernsey") || 
		(strCountry == "Croatia") || (strCountry == "Guadeloupe") || (strCountry == "Isle of Man") || (strCountry == "Kuwait") || 
		(strCountry == "Cayman Islands") || (strCountry == "Liechtenstein") || (strCountry == "Montenegro") || 
		(strCountry == "St Martin (French)") || (strCountry == "Northern Mariana Islands") || (strCountry == "Oman") || 
		(strCountry == "St Helena") || (strCountry == "Slovenia") || (strCountry == "Svalbard & Jan Mayen") || 
		(strCountry == "Slovakia") || (strCountry == "San Marino") || (strCountry == "St Maarten (Dutch)") ||
		(strCountry.indexOf("Virgin Islands") > -1) || (strCountry == "Mayotte"))
	{
		document.getElementById("TenDollarCountry").style.display = "block";
	}
	else if ((strCountry == "Brazil") || (strCountry == "China") || (strCountry == "Fiji") || (strCountry == "Georgia") || 
			(strCountry == "Hong Kong") || (strCountry == "Malaysia") || (strCountry == "Peru") || (strCountry == "St Pierre & Miquelon") || 
			(strCountry == "Qatar") || (strCountry == "Solomon Islands") || (strCountry == "Seychelles") || (strCountry == "Tuvalu") || 
			(strCountry == "Dominica") || (strCountry == "Grenada") || (strCountry == "St Lucia") || (strCountry == "Montserrat"))
	{
		document.getElementById("FiveDollarCountry").style.display = "block";
	}
	else if ((strCountry == "Egypt") || (strCountry == "Cuba") || (strCountry == "Moldova") || (strCountry == "Mauritius") || 
				(strCountry == "Maldives") || (strCountry == "Mexico") || (strCountry == "Thailand") || (strCountry == "Ukraine") || 
				(strCountry == "Uruguay") || (strCountry == "Venezuela") || (strCountry == "South Africa") || 
				(strCountry == "Botswana") || (strCountry == "North Macedonia") || (strCountry == "Mauritania"))
	{
		document.getElementById("OneDollarCountry").style.display = "block";
	}
	else
	{
		document.getElementById("FiftyCentCountry").style.display = "block";
	}
}

function DoLogin(strTargetPassword, strCourseName)
{
	let inputPassword = document.getElementById("password");
	let divContent = document.getElementById("course_content");
	let divLogin = document.getElementById("login");
	let divContentHeader = document.getElementById("ContentHeader");
	
	if (inputPassword && divContent && divLogin)
	{
		if ((inputPassword.value === strTargetPassword) || ((sessionStorage[strCourseName]) && (sessionStorage[strCourseName].length > 0)))
		{
			divContent.style.display = "block";
			divLogin.style.display = "none";
			sessionStorage[strCourseName] = strTargetPassword;
			if (sessionStorage["current_stage"] && (sessionStorage["current_stage"].length > 0))
			{
				//console.log("sessionStorage['current_stage'] = " + sessionStorage["current_stage"]);
				let divStage = document.getElementById(sessionStorage["current_stage"]);
				if (!divStage)
				{
					sessionStorage["current_stage"] = "Stage0";
					divStage = document.getElementById(sessionStorage["current_stage"]);
				}
				if (divStage)
					divStage.style.display = "block";
					
			}
			else if (document.getElementById('Stage0'))
			{
				//console.log("document.getElementById('Stage1') = " + document.getElementById("Stage1"));
				document.getElementById("Stage0").style.display = "block";
			}
			divContentHeader.style.display = "block";
			
			if (!sessionStorage["current_stage"] || (sessionStorage["current_stage"].length == 0))
				sessionStorage["current_stage"] = "Stage0";
								
			DoHighlightCurrentStageLink(sessionStorage["current_stage"] + "Heading", "");
		}
	}
}

function DoNext(nStageNum)
{
	let nNextStageNum = nStageNum + 1;
	
	console.group("Next");
	console.log("nStageNum = " + nStageNum);
	console.log("nNextStageNum = " + nNextStageNum);
	DoShowHide("Stage" + nNextStageNum, "Stage" + nStageNum);
	console.groupEnd();
}

function DoPrevious(nStageNum)
{
	let nPrevStageNum = nStageNum - 1;
	
	console.group("Previous");
	console.log("nStageNum = " + nStageNum);
	console.log("nPrevStageNum = " + nPrevStageNum);
	DoShowHide("Stage" + nPrevStageNum, "Stage" + nStageNum);
	console.groupEnd();
}

function DoNextPage(strPage)
{
	sessionStorage["current_stage"] = 0;
	document.location = strPage;
}


function DoNextPage(strPage)
{
	sessionStorage["current_stage"] = 0;
	document.location = strPage;
}

function DoShowHide(strIDDiv2Show, strIDDiv2Hide)
{
	var div2Hide = document.getElementById(strIDDiv2Hide),
		div2Show = document.getElementById(strIDDiv2Show),
		strIDLink2Highlight = "", 
		strIDLink2Unhighlight = "";
		
	console.log("strIDDiv2Show = " + strIDDiv2Show);
	console.log("strIDDiv2Hide = " + strIDDiv2Hide);

	if (div2Hide)
	{
		div2Hide.style.display = "none";
		strIDLink2Unhighlight = strIDDiv2Hide + "Heading";
	}
	else
	{
		strIDLink2Unhighlight = "Stage1Heading";
	}
	if (div2Show)
	{
		div2Show.style.display = "block";
		sessionStorage["previous_stage"] = sessionStorage["current_stage"];
		sessionStorage["current_stage"] = strIDDiv2Show;
		strIDLink2Highlight = strIDDiv2Show + "Heading";
		//alert(sessionStorage["current_stage"]);
	}
	DoHighlightCurrentStageLink(strIDLink2Highlight, strIDLink2Unhighlight);
}

function DrawFirstStageButtons(strStartPage, nStageNum)
{
	g_nStageNum++;
	document.write("<button type=\"button\" class=\"PreviousNextButtons\" onclick=\"DoPreviousPage('" + strStartPage + "')\">&lt; PREVIOUS</button>&nbsp;");
	document.write("<button type=\"button\" class=\"PreviousNextButtons\" onclick=\"DoNext(" + nStageNum + ")\">NEXT &gt;</button>");
	
	return nStageNum + 1;
}

function DrawLastStageButtons(strNextPage, nStageNum)
{	
	document.write("<button type=\"button\" class=\"PreviousNextButtons\" onclick=\"DoPrevious(" + nStageNum + ")\">&lt; PREVIOUS</button>");
	if (strNextPage.length > 0)
		document.write("&nbsp;<button type=\"button\" class=\"PreviousNextButtons\" onclick=\"DoNextPage('" + strNextPage + "')\">NEXT &gt;</button>&nbsp;");
console.log("***************");
console.log(nStageNum);	
console.log("***************");

	return nStageNum + 1;
}

function DrawMidStageButtons(nStageNum)
{
	let nNextStageNum = nStageNum;
	let nPrevStageNum = nStageNum - 2;
	
	document.write("<button type=\"button\" class=\"PreviousNextButtons\" onclick=\"DoPrevious(" + nStageNum + ")\">&lt; PREVIOUS</button>&nbsp;");
	document.write("<button type=\"button\" class=\"PreviousNextButtons\" onclick=\"DoNext(" + nStageNum + ")\">NEXT &gt;</button>");
	
	return nStageNum + 1;
}

function OnClickStageLink(strIDStageDiv2Show)
{
	DoShowHide(strIDStageDiv2Show, sessionStorage["current_stage"]);
}

function GenerateStageMenu()
{
	let divContentHeader = document.getElementById("ContentHeader");
	let divCourseContent = document.getElementById("course_content");

	if (divContentHeader && divCourseContent)
	{
		console.log(g_arrayStageBookmarks);
		divContentHeader.style.display = divCourseContent.style.display;
		for (let nI = 0; nI < g_arrayStageBookmarks.length; nI++)
		{
			divContentHeader.innerHTML += g_arrayStageBookmarks[nI];
		}
	}
}

function SetStageDivIDs(strStageLinkID)
{
	const divCourseContent = document.getElementById("course_content");
	
	if (divCourseContent)
	{
		let strTagName = "";
		
		console.group("STAGE IDs");
		for (let nI = 0; nI < divCourseContent.children.length; nI++)
		{
			strTagName = divCourseContent.children[nI].tagName;
			if (strTagName == "DIV")
			{
				divCourseContent.children[nI].id = "Stage" + nI.toString();
				console.log(divCourseContent.children[nI].id);
				
				for (let nJ = 0; nJ < divCourseContent.children[nI].children.length; nJ++)
				{
					strTagName = divCourseContent.children[nI].children[nJ].tagName;
					if (strTagName == "H2")
					{
						divCourseContent.children[nI].children[nJ].id = "Stage" + nI.toString() + "Heading";
						console.log(nI + ") " + divCourseContent.children[nI].children[nJ].innerText);
						g_arrayStageBookmarks.push("<a href=\"#\" class=\"StageLink\" id=\"" + 
																	divCourseContent.children[nI].children[nJ].innerText +
																	"\" onclick=\"OnClickStageLink('" +
																	divCourseContent.children[nI].id + "') \">" + 
																	divCourseContent.children[nI].children[nJ].innerText + "</a>");
						break;
					}
				}
			}
		}
		console.groupEnd();
		GenerateStageMenu();
	}
}

function GetAsHTMLTags(arrayLinesHTML)
{
	let strHTML = "";
	
	for (let nI = 0; nI < arrayLinesHTML.length; nI++)
	{
		strHTML += arrayLinesHTML[nI];
	}
	return strHTML;
}

function WriteAsHTMLTags(arrayLinesHTML)
{
	document.write(GetAsHTMLTags(arrayLinesHTML));
}

function Replace(strText, strReplaceWhat, strReplaceWith)
{
	let nI = strText.indexOf(strReplaceWhat);
	
	while (nI > -1)
	{
		strText = strText.replace(strReplaceWhat, strReplaceWith);
		nI = strText.indexOf(strReplaceWhat);
	}
	return strText;
}

function GetAsHTMLCode(arrayLinesHTML)
{
	let strHTMLCode = "", strLineHTML = "";
	
	for (let nI = 0; nI < arrayLinesHTML.length; nI++)
	{
		strLineHTML = arrayLinesHTML[nI];
		strLineHTML = Replace(strLineHTML, " ", "&nbsp;&nbsp;");
		strLineHTML = Replace(strLineHTML, "<", "&lt;");
		strLineHTML = Replace(strLineHTML, ">", "&gt;");
		strLineHTML = Replace(strLineHTML, "\n", "<br/>");
		if (strLineHTML.indexOf("</script_>") > -1)
			strLineHTML = strLineHTML.replace("</script_>", "</script>")
		strHTMLCode += strLineHTML + "<br/>";
	}
	return strHTMLCode;
}

function WriteAsHTMLCode(arrayLinesHTML)
{
	document.write(GetAsHTMLCode(arrayLinesHTML) + "<br/>");
}

//**********************************************************************************************************************
//**********************************************************************************************************************
//** TRY IT NOW 
//**********************************************************************************************************************
//**********************************************************************************************************************

function GenerateTryItNow()
{
	var divTryItNowHTML = document.getElementById("TryItNowHTML"),
		strHTML = "";
	
	if (divTryItNowHTML)
	{
		strHTML = strHTML.innerHTML;
		document.write(strHTML);
	}
}

function OnClickButtonRunIDs(strIDTextArea, strIDFrame)
{
	let textareaTryItNowCode = document.getElementById(strIDTextArea);
	let iframeTryItNowResults = document.getElementById(strIDFrame);
	
	if (textareaTryItNowCode && iframeTryItNowResults)
	{
		iframeTryItNowResults.srcdoc = textareaTryItNowCode.value;
	}
}

function GetTryItNowCode_(nI, strRunCode, strAddOnCode)
{
	let divTryItNow = document.getElementById("TryItNowHTML");
	let strTryItNowCode = "";
	
	if (divTryItNow)
	{
		strTryItNowCode = divTryItNow.innerHTML;
		strTryItNowCode = strTryItNowCode.replace("id=\"TryItNowCode", "id=\"TryItNowCode" + nI.toString());
		strTryItNowCode = strTryItNowCode.replace("id=\"TryItNowResults", "id=\"TryItNowResults" + nI.toString());
		strTryItNowCode = strTryItNowCode.replace("OnClickButtonRun()", "OnClickButtonRunIDs('TryItNowCode" + nI.toString() + "', 'TryItNowResults" + nI.toString() + "')");
		if (strRunCode)
			strTryItNowCode = strTryItNowCode.replace("XXXX", strRunCode);
		else
			strTryItNowCode = strTryItNowCode.replace("XXXX", "");
			
		if (strAddOnCode)
			strTryItNowCode = strTryItNowCode.replace("ADD_ON_CODE", strAddOnCode);
		else
			strTryItNowCode = strTryItNowCode.replace("ADD_ON_CODE", "");
	}
	return strTryItNowCode;
}

//**********************************************************************************************************************
//**********************************************************************************************************************
//** BACKGROUND COLOR TRY IT NOW 
//**********************************************************************************************************************
//**********************************************************************************************************************

let g_bTargetIsBG = true;

function OnClickRadioTarget(radioTarget)
{
	if (radioTarget)
	{
		g_bTargetIsBG = radioTarget.id == "color_target_background";
	}
}

function OnClickRadioColor(inputRadio, textareaCode, iframeResults)
{
	if (inputRadio && textareaCode && iframeResults)
	{
		let strCode = textareaCode.value,
			nPos1 = -1,
			nPos2 = -1,
			nPos3 = -1;
			
		if (g_bTargetIsBG)
		{
			nPos1 = strCode.indexOf("background-color");
			
			if (nPos1 > -1)
			{
				nPos2 = strCode.indexOf(";", nPos1);
				if (nPos2 > -1)
				{
					strCode = strCode.slice(0, nPos1) + inputRadio.value + strCode.slice(nPos2, strCode.length);
					textareaCode.value = strCode;
					iframeResults.srcdoc = strCode;
				}
			}
		}
		else
		{
			nPos1 = strCode.indexOf("\"color");
			if (nPos1 == -1)
				nPos1 = strCode.indexOf(";color");
			
			if (nPos1 > -1)
			{
				nPos2 = strCode.indexOf(";", nPos1 + 1);
				if (nPos2 > -1)
				{
					nPos3 = inputRadio.value.indexOf("-");
					strCode = strCode.slice(0, nPos1 + 1) + inputRadio.value.slice(nPos3 + 1) + strCode.slice(nPos2, strCode.length);
					textareaCode.value = strCode;
					iframeResults.srcdoc = strCode;
				}
			}
		}
	}
}

function OnClickRadioColorRGB_HSL_HEX(inputRadio, textareaCode, iframeResults)
{
	// Enable and disable number fields
	let numberRGBRed = document.getElementById("text-color-RGB-red"),
		numberRGBGreen = document.getElementById("text-color-RGB-green"),
		numberRGBBlue = document.getElementById("text-color-RGB-blue"),
		numberRGBOpacity = document.getElementById("text-color-RGB-opacity"),
		numberHSLHue = document.getElementById("text-color-HSL-hue"),
		numberHSLSaturation = document.getElementById("text-color-HSL-saturation"),
		numberHSLLightness = document.getElementById("text-color-HSL-lightness"),
		numberHSLOpacity = document.getElementById("text-color-HSL-opacity"),
		numberHEXRed = document.getElementById("text-color-HEX-red"),
		numberHEXGreen = document.getElementById("text-color-HEX-green"),
		numberHEXBlue = document.getElementById("text-color-HEX-blue");
		
	if (numberRGBRed && numberRGBGreen && numberRGBBlue && numberRGBOpacity && 
		numberHSLHue && numberHSLSaturation && numberHSLLightness && numberHSLOpacity &&
		numberHEXRed && numberHEXGreen && numberHEXBlue && inputRadio && textareaCode && iframeResults)
	{
		numberRGBRed.disabled = inputRadio.id.indexOf("radio-color-rgb") == -1;
		numberRGBGreen.disabled = inputRadio.id.indexOf("radio-color-rgb") == -1;
		numberRGBBlue.disabled = inputRadio.id.indexOf("radio-color-rgb") == -1;
		numberRGBOpacity.disabled = inputRadio.id != "radio-color-rgba";

		numberHSLHue.disabled = inputRadio.id.indexOf("radio-color-hsl") == -1;
		numberHSLSaturation.disabled = inputRadio.id.indexOf("radio-color-hsl") == -1;
		numberHSLLightness.disabled = inputRadio.id.indexOf("radio-color-hsl") == -1;
		numberHSLOpacity.disabled = inputRadio.id != "radio-color-hsla";

		numberHEXRed.disabled = inputRadio.id.indexOf("radio-color-hex") == -1;
		numberHEXGreen.disabled = inputRadio.id.indexOf("radio-color-hex") == -1;
		numberHEXBlue.disabled = inputRadio.id.indexOf("radio-color-hex") == -1;
	}
	OnClickRadioColor(inputRadio, textareaCode, iframeResults);
}

function ReplaceInt(nIntNum, strCode, nNewIntVal, bIsHex, strAddOn)
{
	let nPos1 = -1, nPos2 = -1,
		strPadding = "";
	
	if (bIsHex)
	{
		if (nNewIntVal <= 15)
			strPadding = "0";
			
		nPos1 = strCode.indexOf("#") + (nIntNum * 2);
		nPos2 = nPos1 + 2;
		strCode = strCode.slice(0, nPos1 + 1) + strPadding + nNewIntVal.toString(16) + strCode.slice(nPos2 + 1, strCode.length);
	}
	else
	{
		nPos1 = strCode.indexOf("(");
		nPos2 = strCode.indexOf(",", nPos1);

		for (let nI = 0; nI < nIntNum; nI++)
		{
			nPos1 = nPos2;
			nPos2 = strCode.indexOf(",", nPos1 + 1);
		}
		if (nPos2 < -1)
			nPos2 = strCode.indexOf(")");
		
		if (nIntNum == 3)
			nNewIntVal /= 10;
		strCode = strCode.slice(0, nPos1 + 1) + nNewIntVal.toString() + strAddOn + strCode.slice(nPos2, strCode.length)
	}
	return strCode;
}

function OnChangeRGBRed(inputNumber, inputRadioRGB, inputRadioRGBA, textareaCode, iframeResults)
{
	if (inputRadioRGB && inputRadioRGBA && textareaCode && iframeResults)
	{
		let strCode = "",
			inputRadio = null;
		
		if (inputRadioRGB.checked)
		{
			strCode = inputRadioRGB.value;
			inputRadio = inputRadioRGB;
		}
		else if (inputRadioRGBA.checked)
		{
			strCode = inputRadioRGBA.value;
			inputRadio = inputRadioRGBA;
		}
		strCode = ReplaceInt(0, strCode, Number(inputNumber.value), false, "");
		inputRadio.value = strCode;
		OnClickRadioColor(inputRadio, textareaCode, iframeResults);
	}
}

function OnChangeRGBGreen(inputNumber, inputRadioRGB, inputRadioRGBA, textareaCode, iframeResults)
{
	if (inputRadioRGB && inputRadioRGBA && textareaCode && iframeResults)
	{
		let strCode = "",
			inputRadio = null;
		
		if (inputRadioRGB.checked)
		{
			strCode = inputRadioRGB.value;
			inputRadio = inputRadioRGB;
		}
		else if (inputRadioRGBA.checked)
		{
			strCode = inputRadioRGBA.value;
			inputRadio = inputRadioRGBA;
		}
		strCode = ReplaceInt(1, strCode, Number(inputNumber.value), false, "");
		inputRadio.value = strCode;
		OnClickRadioColor(inputRadio, textareaCode, iframeResults);
	}
}

function OnChangeRGBBlue(inputNumber, inputRadioRGB, inputRadioRGBA, textareaCode, iframeResults)
{
	if (inputRadioRGB && inputRadioRGBA && textareaCode && iframeResults)
	{
		let strCode = "",
			inputRadio = null;
		
		if (inputRadioRGB.checked)
		{
			strCode = inputRadioRGB.value;
			inputRadio = inputRadioRGB;
		}
		else if (inputRadioRGBA.checked)
		{
			strCode = inputRadioRGBA.value;
			inputRadio = inputRadioRGBA;
		}
		strCode = ReplaceInt(2, strCode, Number(inputNumber.value), false, "");
		inputRadio.value = strCode;
		OnClickRadioColor(inputRadio, textareaCode, iframeResults);
	}
}

function OnChangeRGBOpacity(inputNumber, inputRadioRGB, inputRadioRGBA, textareaCode, iframeResults)
{
	if (inputRadioRGB && inputRadioRGBA && textareaCode && iframeResults)
	{
		let strCode = "",
			inputRadio = null;
		
		if (inputRadioRGB.checked)
		{
			strCode = inputRadioRGB.value;
			inputRadio = inputRadioRGB;
		}
		else if (inputRadioRGBA.checked)
		{
			strCode = inputRadioRGBA.value;
			inputRadio = inputRadioRGBA;
		}
		strCode = ReplaceInt(3, strCode, Number(inputNumber.value), false, "");
		inputRadio.value = strCode;
		OnClickRadioColor(inputRadio, textareaCode, iframeResults);
	}
}

function OnChangeHSLHue(inputNumber, inputRadioHSL, inputRadioHSLA, textareaCode, iframeResults)
{
	if (inputRadioHSL && inputRadioHSLA && textareaCode && iframeResults)
	{
		let strCode = "",
			inputRadio = null;
		
		if (inputRadioHSL.checked)
		{
			strCode = inputRadioHSL.value;
			inputRadio = inputRadioHSL;
		}
		else if (inputRadioHSLA.checked)
		{
			strCode = inputRadioHSLA.value;
			inputRadio = inputRadioHSLA;
		}
		strCode = ReplaceInt(0, strCode, Number(inputNumber.value), false, "");
		inputRadio.value = strCode;
		OnClickRadioColor(inputRadio, textareaCode, iframeResults);
	}
}

function OnChangeHSLSaturation(inputNumber, inputRadioHSL, inputRadioHSLA, textareaCode, iframeResults)
{
	if (inputRadioHSL && inputRadioHSLA && textareaCode && iframeResults)
	{
		let strCode = "",
			inputRadio = null;
		
		if (inputRadioHSL.checked)
		{
			strCode = inputRadioHSL.value;
			inputRadio = inputRadioHSL;
		}
		else if (inputRadioHSLA.checked)
		{
			strCode = inputRadioHSLA.value;
			inputRadio = inputRadioHSLA;
		}
		strCode = ReplaceInt(1, strCode, Number(inputNumber.value), false, "%");
		inputRadio.value = strCode;
		OnClickRadioColor(inputRadio, textareaCode, iframeResults);
	}
}

function OnChangeHSLLightness(inputNumber, inputRadioHSL, inputRadioHSLA, textareaCode, iframeResults)
{
	if (inputRadioHSL && inputRadioHSLA && textareaCode && iframeResults)
	{
		let strCode = "",
			inputRadio = null;
		
		if (inputRadioHSL.checked)
		{
			strCode = inputRadioHSL.value;
			inputRadio = inputRadioHSL;
		}
		else if (inputRadioHSLA.checked)
		{
			strCode = inputRadioHSLA.value;
			inputRadio = inputRadioHSLA;
		}
		strCode = ReplaceInt(2, strCode, Number(inputNumber.value), false, "%");
		inputRadio.value = strCode;
		OnClickRadioColor(inputRadio, textareaCode, iframeResults);
	}
}

function OnChangeHSLOpacity(inputNumber, inputRadioHSL, inputRadioHSLA, textareaCode, iframeResults)
{
	if (inputRadioHSL && inputRadioHSLA && textareaCode && iframeResults)
	{
		let strCode = "",
			inputRadio = null;
		
		if (inputRadioHSL.checked)
		{
			strCode = inputRadioHSL.value;
			inputRadio = inputRadioHSL;
		}
		else if (inputRadioHSLA.checked)
		{
			strCode = inputRadioHSLA.value;
			inputRadio = inputRadioHSLA;
		}
		strCode = ReplaceInt(3, strCode, Number(inputNumber.value), false, "");
		inputRadio.value = strCode;
		OnClickRadioColor(inputRadio, textareaCode, iframeResults);
	}
}

function OnChangeHEXRed(inputNumber, inputRadio, textareaCode, iframeResults)
{
	if (inputNumber && inputRadio && textareaCode && iframeResults)
	{
		let strCode = inputRadio.value;
		strCode = ReplaceInt(0, strCode, Number(inputNumber.value), true, "");
		inputRadio.value = strCode;
		OnClickRadioColor(inputRadio, textareaCode, iframeResults);
	}
}

function OnChangeHEXGreen(inputNumber, inputRadio, textareaCode, iframeResults)
{
	if (inputNumber && inputRadio && textareaCode && iframeResults)
	{
		let strCode = inputRadio.value;
		strCode = ReplaceInt(1, strCode, Number(inputNumber.value), true, "");
		inputRadio.value = strCode;
		OnClickRadioColor(inputRadio, textareaCode, iframeResults);
	}
}

function OnChangeHEXBlue(inputNumber, inputRadio, textareaCode, iframeResults)
{
	if (inputNumber && inputRadio && textareaCode && iframeResults)
	{
		let strCode = inputRadio.value;
		strCode = ReplaceInt(2, strCode, Number(inputNumber.value), true, "");
		inputRadio.value = strCode;
		OnClickRadioColor(inputRadio, textareaCode, iframeResults);
	}
}

//**********************************************************************************************************************
//**********************************************************************************************************************
//** BACKGROUND IMAGE TRY IT NOW
//**********************************************************************************************************************
//**********************************************************************************************************************

function OnClickRadioBackgroundImg(inputRadioButton, textareaCode, iframeResults)
{
	if (textareaCode)
	{
		let strValue = inputRadioButton.value,
			strCode = textareaCode.value,
			nPos1 = -1, nPos2 = -1,
			strLeft = "", strRight = "";
		
		// Update the code in the text area.
		if (strValue.search("background-repeat") > -1)
		{
			nPos1 = strCode.indexOf("background-repeat");
		}
		else if (strValue.search("background-repeat") > -1)
		{
			nPos1 = strCode.indexOf("background-repeat");
		}
		else if (strValue.search("background-position") > -1)
		{
			nPos1 = strCode.indexOf("background-position");
		}
		else if (strValue.search("background-size") > -1)
		{
			nPos1 = strCode.indexOf("background-size");
		}
		else if (strValue.search("background-origin") > -1)
		{
			nPos1 = strCode.indexOf("background-origin");
		}
		nPos2 = strCode.indexOf(";", nPos1);
		strLeft = strCode.slice(0, nPos1);
		strRight = strCode.slice(nPos2 + 1, strCode.length);
		strCode = strLeft + strValue + strRight;
		textareaCode.value = strCode;
		OnClickButtonRunIDs(textareaCode.id, iframeResults.id);

		// Enable and disable number fields according to which radio button is checked.
		if (inputRadioButton.id == "radio-background-position-xy-percentage")
		{
			document.getElementById("text-background-position-xy-percentage-x").disabled = !inputRadioButton.checked;
			document.getElementById("text-background-position-xy-percentage-y").disabled = !inputRadioButton.checked;
			document.getElementById("text-background-position-xy-pixel-x").disabled = inputRadioButton.checked;
			document.getElementById("text-background-position-xy-pixel-y").disabled = inputRadioButton.checked;
		}
		else if (inputRadioButton.id == "radio-background-position-xy-pixels")
		{
			document.getElementById("text-background-position-xy-percentage-x").disabled = inputRadioButton.checked;
			document.getElementById("text-background-position-xy-percentage-y").disabled = inputRadioButton.checked;
			document.getElementById("text-background-position-xy-pixel-x").disabled = !inputRadioButton.checked;
			document.getElementById("text-background-position-xy-pixel-y").disabled = !inputRadioButton.checked;
		}
		else if (inputRadioButton.id == "radio-background-position-xy")
		{
			document.getElementById("text-background-position-xy-percentage-x").disabled = true;
			document.getElementById("text-background-position-xy-percentage-y").disabled = true;
			document.getElementById("text-background-position-xy-pixel-x").disabled = true;
			document.getElementById("text-background-position-xy-pixel-y").disabled = true;
		}
		else if (inputRadioButton.id == "radio-background-size-percentage")
		{
			document.getElementById("text-background-size-percentage-x").disabled = !inputRadioButton.checked;
			document.getElementById("text-background-size-percentage-y").disabled = !inputRadioButton.checked;
			document.getElementById("text-background-size-length-x").disabled = inputRadioButton.checked;
			document.getElementById("text-background-size-length-y").disabled = inputRadioButton.checked;
		}
		else if (inputRadioButton.id == "radio-background-size-length")
		{
			document.getElementById("text-background-size-percentage-x").disabled = inputRadioButton.checked;
			document.getElementById("text-background-size-percentage-y").disabled = inputRadioButton.checked;
			document.getElementById("text-background-size-length-x").disabled = !inputRadioButton.checked;
			document.getElementById("text-background-size-length-y").disabled = !inputRadioButton.checked;
		}
		else if (inputRadioButton.id == "radio-background-size")
		{
			document.getElementById("text-background-size-percentage-x").disabled = true;
			document.getElementById("text-background-size-percentage-y").disabled = true;
			document.getElementById("text-background-size-length-x").disabled = true;
			document.getElementById("text-background-size-length-y").disabled = true;
		}
		else if (inputRadioButton.id == "radio-background-position-x-percentage")
		{
			document.getElementById("text-background-position-x-percentage").disabled = !inputRadioButton.checked;
			document.getElementById("text-background-position-x-pixel").disabled = inputRadioButton.checked;
		}
		else if (inputRadioButton.id == "radio-background-position-x-pixels")
		{
			document.getElementById("text-background-position-x-percentage").disabled = inputRadioButton.checked;
			document.getElementById("text-background-position-x-pixel").disabled = !inputRadioButton.checked;
		}
		else if (inputRadioButton.id == "radio-background-position-x")
		{
			document.getElementById("text-background-position-x-percentage").disabled = true;
			document.getElementById("text-background-position-x-pixel").disabled = true;
		}
		else if (inputRadioButton.id == "radio-background-position-y-percentage")
		{
			document.getElementById("text-background-position-y-percentage").disabled = !inputRadioButton.checked;
			document.getElementById("text-background-position-y-pixel").disabled = inputRadioButton.checked;
		}
		else if (inputRadioButton.id == "radio-background-position-y-pixels")
		{
			document.getElementById("text-background-position-y-percentage").disabled = inputRadioButton.checked;
			document.getElementById("text-background-position-y-pixel").disabled = !inputRadioButton.checked;
		}
		else if (inputRadioButton.id == "radio-background-position-y")
		{
			document.getElementById("text-background-position-y-percentage").disabled = true;
			document.getElementById("text-background-position-y-pixel").disabled = true;
		}
	}
}

function OnChangeX(inputNum, inputRadio, textareaCode, iframeResults)
{
	if (inputRadio)
	{
		let strValue = inputRadio.value,
			nPos1 = -1, nPos2 = -1;
		
		/*
			:0px 0px
			:0% 0%
			:0px
			:0%
		*/
		nPos1 = strValue.indexOf(":");
		nPos2 = strValue.indexOf("px", nPos1);
		if (nPos2 == -1)
			nPos2 = strValue.indexOf("%", nPos1);
		
		strValue = strValue.slice(0, nPos1 + 1) + inputNum.value + strValue.slice(nPos2, strValue.length);
		inputRadio.value = strValue;
		OnClickRadioBackgroundImg(inputRadio, textareaCode, iframeResults);
	}
}

function OnChangeY(inputNum, inputRadio, textareaCode, iframeResults)
{
	if (inputRadio)
	{
		let strValue = inputRadio.value,
			nPos1 = -1, nPos2 = -1;
		
		/*
			:0px 0px
			:0% 0%
			:0px
			:0%
		*/
		nPos1 = strValue.lastIndexOf(" ");
		if (nPos1 == -1)
			nPos1 = strValue.lastIndexOf(":");
		nPos2 = strValue.lastIndexOf("px");
		if (nPos2 == -1)
			nPos2 = strValue.lastIndexOf("%");
		strValue = strValue.slice(0, nPos1 + 1) + inputNum.value + strValue.slice(nPos2, strValue.length);
		inputRadio.value = strValue;
		OnClickRadioBackgroundImg(inputRadio, textareaCode, iframeResults);
	}
}

//**********************************************************************************************************************
//**********************************************************************************************************************
//** MARGIN TRY IT NOW
//**********************************************************************************************************************
//**********************************************************************************************************************

function OnClickRadioMargin(inputRadio, textareaTryItNowCode, iframeTryItNowResults)
{
	if (inputRadio && textareaTryItNowCode && iframeTryItNowResults)
	{
		let strAttr = inputRadio.value,
			strCode = textareaTryItNowCode.value,
			nPos1 = strCode.indexOf("margin"),
			nPos2 = strCode.indexOf(";", nPos1);
		
		strCode = strCode.substr(0, nPos1) + strAttr + strCode.substr(nPos2 + 1, strCode.length - 1);
		textareaTryItNowCode.value = strCode;
		OnClickButtonRunIDs(textareaTryItNowCode.id, iframeTryItNowResults.id);
	}
}

function OnClickRadioPadding(inputRadio, textareaTryItNowCode, iframeTryItNowResults)
{
	if (inputRadio && textareaTryItNowCode && iframeTryItNowResults)
	{
		let strAttr = inputRadio.value,
			strCode = textareaTryItNowCode.value,
			nPos1 = strCode.indexOf("padding"),
			nPos2 = strCode.indexOf(";", nPos1);
		
		strCode = strCode.substr(0, nPos1) + strAttr + strCode.substr(nPos2 + 1, strCode.length - 1);
		textareaTryItNowCode.value = strCode;
		OnClickButtonRunIDs(textareaTryItNowCode.id, iframeTryItNowResults.id);
	}
}

function OnClickRadioOverflow(inputRadio, textareaTryItNowCode, iframeTryItNowResults)
{
	if (inputRadio && textareaTryItNowCode && iframeTryItNowResults)
	{
		let radioOverflow = document.getElementById("radio-overflow"),
			radioOverflowXOnly = document.getElementById("radio-overflow-x-only"),
			radioOverflowYOnly = document.getElementById("radio-overflow-y-only"),
			radioOverflowXY = document.getElementById("radio-overflow-xy"),
			selectOverflow = document.getElementById("select-overflow"),
			selectOverflowXOnly = document.getElementById("select-overflow-x-only"),
			selectOverflowYOnly = document.getElementById("select-overflow-y-only"),
			selectOverflowX = document.getElementById("select-overflow-x"),
			selectOverflowY = document.getElementById("select-overflow-y"),
			strAttr = "",
			strCode = textareaTryItNowCode.value,
			nPos1 = -1,
			nPos2 = -1;
		
		if (radioOverflow && selectOverflow)
		{
			selectOverflow.disabled = !radioOverflow.checked;
			if (radioOverflow.checked)
				strAttr = radioOverflow.value + selectOverflow.options[selectOverflow.selectedIndex].text;
		}
		if (radioOverflowXOnly && selectOverflowXOnly)
		{
			selectOverflowXOnly.disabled = !radioOverflowXOnly.checked;
			if (radioOverflowXOnly.checked)
				strAttr = radioOverflowXOnly.value + selectOverflowXOnly.options[selectOverflowXOnly.selectedIndex].text;
		}
		if (radioOverflowYOnly && selectOverflowYOnly)
		{
			selectOverflowYOnly.disabled = !radioOverflowYOnly.checked;
			if (radioOverflowYOnly.checked)
				strAttr = radioOverflowYOnly.value + selectOverflowYOnly.options[selectOverflowYOnly.selectedIndex].text;
		}
		if (radioOverflowXY && selectOverflowX && selectOverflowY)
		{
			selectOverflowX.disabled = !radioOverflowXY.checked;
			selectOverflowY.disabled = !radioOverflowXY.checked;
			if (radioOverflowXY.checked)
			{
				strAttr = radioOverflowXY.value;
				strAttr = strAttr.replace("XXXX", selectOverflowX.options[selectOverflowX.selectedIndex].text);
				strAttr = strAttr.replace("YYYY", selectOverflowY.options[selectOverflowY.selectedIndex].text);
			}
		}
		nPos1 = strCode.indexOf("overflow");
		nPos2 = strCode.indexOf("overflow", nPos1 + 8);
		if (nPos2 == -1)
			nPos2 = nPos1 + 8;
		nPos2 = strCode.indexOf(";", nPos2);
		strCode = strCode.substr(0, nPos1) + strAttr + strCode.substr(nPos2, strCode.length - 1);
		textareaTryItNowCode.value = strCode;
		OnClickButtonRunIDs(textareaTryItNowCode.id, iframeTryItNowResults.id);
	}
}

function OnClickRadioPosition(inputRadio, divPosDemo)
{
	if (inputRadio && divPosDemo)
	{
		let	radioRelative = document.getElementById("radio-relative"),
			numberPosX = document.getElementById("position-x"),
			numberPosY = document.getElementById("position-y");
			
		if (numberPosX && numberPosY && radioRelative)
		{
			numberPosX.disabled = !radioRelative.checked;
			numberPosY.disabled = !radioRelative.checked;
		}
		divPosDemo.style.position = inputRadio.value;
	}
}

function OnChangePositionX(inputNumberPositionX, divPosDemo)
{
	if (inputNumberPositionX && divPosDemo)
	{
		divPosDemo.style.left = inputNumberPositionX.value + "px";
	}
}

function OnChangePositionY(inputNumberPositionY, divPosDemo)
{
	if (inputNumberPositionY && divPosDemo)
	{
		divPosDemo.style.top = inputNumberPositionY.value + "px";
	}
}

